<?php

namespace App\Http\Livewire\Proposal;

use App\Actions\Address\UpdateAddress;
use App\Actions\Person\CreateNewPerson;
use App\Actions\Person\UpdatePerson;
use App\Actions\Person\UpdatePersonDetail;
use App\Actions\Proposal\CreateNewProposal;
use App\Actions\Proposal\UpdateProposal;
use App\Events\ProposalCreated;
use App\Events\ProposalUpdated;
use App\Http\Livewire\RedirectHandler;
use App\Models\Lot;
use App\Models\Person;
use App\Models\Proposal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Wizard extends Component
{
    use RedirectHandler, AuthorizesRequests;

    /**
     * O lote para o qual a proposta será realizada.
     *
     * @var Lot
     */
    public Lot $lot;

    public Proposal $proposal;

    /**
     * Todos os dados da proposta.
     *
     * @var mixed
     */
    public $state = [
        'proponents' => [],
        'financial' => [],
        'documents' => []
    ];

    /**
     * A configuração dos passos do formulário
     *
     * @var
     */
    public $steps;

    /**
     * O passo atual do formulário
     *
     * @var string
     */
    public $currentStep = 'proponent-step';

    /**
     * Event listeners
     *
     * @var string[]
     */
    protected $listeners = [
        'proponentsData' => 'addProponents',
        'financialData' => 'addFinancialData',
        'documentsData' => 'addDocumentsData'
    ];

    /**
     * Inicialização do formulário
     *
     * @param Lot $lot
     */
    public function mount(Lot $lot, Proposal $proposal)
    {
        $this->lot = $lot;
        $this->proposal = $proposal;
        $this->steps = WizardSteps::STEPS;
    }

    /**
     * Adiciona os dados dos proponentes ao estado.
     *
     * @param $data
     */
    public function addProponents($data)
    {
        $this->state['proponents'] = $data;
    }

    /**
     * Adiciona os dados financeiros ao estado.
     *
     * @param $data
     */
    public function addFinancialData($data)
    {
        $this->state['financial'] = $data;
    }

    /**
     * Adiciona os documentos ao estado.
     *
     * @param $data
     */
    public function addDocumentsData($data)
    {
        $this->state['documents'] = $data;
    }

    /**
     * Avança para o próximo passo do formulário
     */
    public function nextStep()
    {
        $this->emit('reportData')->component($this->steps[$this->currentStep]['component']);
        if ($this->state[$this->steps[$this->currentStep]['dataLabel']]) {
            $this->currentStep = $this->steps[$this->currentStep]['nextStep'];
        }
    }

    /**
     * @throws \Throwable
     */
    public function submitProposal()
    {
        $this->emit('reportData')->component($this->steps[$this->currentStep]['component']);
        if ($this->state[$this->steps[$this->currentStep]['dataLabel']]) {
            \DB::beginTransaction();

            $action = '';

            try {

                $proponents = collect([]);

                // Salvar os proponentes
                foreach ($this->state['proponents'] as $proponent) {
                    // Criar ou atualizar a pessoa
                    $person = Person::whereCpf($proponent['cpf'])->first();
                    if ($person instanceof Person) {
                        $person = (new UpdatePerson())->update($person, $proponent);
                    } else {
                        $person = (new CreateNewPerson())->create($proponent);
                    }
                    $proponents->push($person);
                    // Atualiza ou cria os detalhes da pessoa
                    (new UpdatePersonDetail())->update($person, $proponent['detail']);
                    // Atualiza ou cria um endereço para a pessoa
                    (new UpdateAddress())->update($person, $proponent['address']);
                    // Criar ou atualizar o cônjuge
                    if (!empty($proponent['partner'])) {
                        $partnerData = $proponent['partner'];
                        $partner = Person::whereCpf($partnerData['cpf'])->first();
                        if ($partner instanceof Person) {
                            $partner = (new UpdatePerson())->update($partner, $partnerData);
                        } else {
                            $partner = (new CreateNewPerson())->create($partnerData);
                        }
                        // Atualiza ou cria os detalhes o cônjuge
                        (new UpdatePersonDetail())->update($partner, $partnerData['detail']);
                        $partner->refresh();
                        $person->refresh();
                        $person->detail->partner_id = $partner->id;
                        $partner->detail->partner_id = $person->id;
                        $person->detail->save();
                    }
                }

                // Salva as informações da proposta
                if ($this->proposal->getAttributes()) {
                    $this->authorize('editProposal', [Proposal::class, $this->proposal]);
                    $proposal = (new UpdateProposal())->update(
                        $this->proposal,
                        \Auth::user(),
                        collect($this->state['financial'])
                    );
                    $action = 'update';
                } else {
                    $this->authorize('create', [Proposal::class, $this->lot]);
                    $proposal = (new CreateNewProposal())->create(
                        $this->lot,
                        \Auth::user(),
                        $proponents,
                        collect($this->state['financial'])
                    );
                    $action = 'create';
                }

                // Salva os documentos da proposta
                foreach ($this->state['documents'] as $document) {
                    $proposal->documents()->create(['filename' => $document]);
                }

                \DB::commit();

                // Dispara o evento correto
                if ($action === 'create') {
                    ProposalCreated::dispatch($proposal->refresh());
                } else {
                    ProposalUpdated::dispatch($proposal->refresh());
                }

                // Redireciona
                $this->successAction('Proposta realizada.', ['lots.index', $proposal->lot->allotment_id], true);
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }
    }

    public function render()
    {
        return view('livewire.proposal.wizard');
    }
}
