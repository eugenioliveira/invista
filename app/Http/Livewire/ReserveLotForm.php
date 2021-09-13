<?php

namespace App\Http\Livewire;

use App\Actions\Person\CreateNewPerson;
use App\Actions\Person\UpdatePerson;
use App\Actions\Reservation\CreateNewReservation;
use App\Models\Lot;
use App\Models\Person;
use App\Models\Reservation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReserveLotForm extends Component
{
    use RedirectHandler, AuthorizesRequests;

    /**
     * O lote que será reservado
     *
     * @var Lot
     */
    public Lot $lot;

    /**
     * O estado do componente
     *
     * @var array
     */
    public array $state = [];

    /**
     * A pessoa selecionada, caso for
     *
     * @var Person|null
     */
    public ?Person $person = null;

    /**
     * Event listeners
     *
     * @var string[]
     */
    protected $listeners = ['personSelected' => 'selectPerson'];

    /**
     * Recebe a pessoa que foi selecionada através da busca.
     *
     * @param Person $person
     */
    public function selectPerson(Person $person)
    {
        $this->person = $person;
        $this->state = $person->only(['first_name', 'last_name', 'cpf', 'phone']);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function reserve(CreateNewReservation $creator, $redirectAfterCreate = true)
    {
        // 1. Determinar se uma pessoa foi selecionada
        if ($this->person instanceof Person) {
            // 2. Caso positivo, atualizar os dados da pessoa
            $personUpdater = new UpdatePerson();
            $personUpdater->update($this->person, $this->state);
        } else {
            // 3. Caso negativo, criar a pessoa
            $personCreator = new CreateNewPerson();
            $this->person = $personCreator->create($this->state);
        }
        // 4. Criar a reserva.
        // O lote a ser reservado
        $lot = $this->lot;
        // O usuário que reservou o lote
        $user = Auth::user();
        // Para quem o lote foi reservado
        $reservable = $this->person;
        // Início imediato da reserva
        $init = now();
        // Fim da reserva como definido nas configurações do loteamento
        $due = now()->addHours($lot->allotment->reservation_duration);

        $this->authorize('create', [Reservation::class, $lot]);

        $creator->create($lot, $user, $reservable, $init, $due);

        // Redireciona
        $this->successAction(
            sprintf(
                'Lote %s do loteamento %s foi reservado para a pessoa %s até %s.',
                $lot->identification,
                $lot->allotment->title,
                $reservable->full_name,
                $due->format('d/m/Y H:i')
            ),
            ['lots.index', $lot->allotment_id],
            $redirectAfterCreate
        );

    }

    public function render()
    {
        return view('livewire.reserve-lot-form');
    }
}
