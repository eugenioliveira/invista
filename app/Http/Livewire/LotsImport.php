<?php

namespace App\Http\Livewire;

use App\Imports\LotsSheetImport;
use App\Models\Allotment;
use App\Models\Lot;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\HeadingRowImport;
use Storage;

class LotsImport extends Component
{
    use WithFileUploads;
    use RedirectHandler;

    /**
     * O loteamento que irá receber os lotes importados
     *
     * @var Allotment
     */
    public Allotment $allotment;

    /**
     * O arquivo de importação
     *
     * @var mixed
     */
    public $importFile;

    /**
     * Flag que determina se deve-se ou não
     * sobrescrever lotes existentes
     *
     * @var mixed
     */
    public $shouldOverwrite = 0;

    /**
     * A coleção de lotes extraídos do arquivo
     *
     * @var Collection
     */
    public Collection $lots;

    /**
     * Exibição da tela de loading
     *
     * @var bool
     */
    public bool $showLoading = false;

    /**
     * Regras de validação
     *
     * @var array
     */
    protected array $rules = [
        'importFile' => ['required', 'file', 'mimes:xls,xlsx,ods']
    ];

    /**
     * Mensagens de validação
     *
     * @var array
     */
    protected array $messages = [
        'importFile.required' => 'Selecione o arquivo.',
        'importFile.file' => 'O arquivo selecionado é inválido.',
        'importFile.mimes' => 'O arquivo selecionado deve ser um arquivo do Excel.'
    ];

    /**
     * Instancia o componente
     *
     * @param Allotment $allotment
     */
    public function mount(Allotment $allotment)
    {
        $this->allotment = $allotment;
        $this->lots = collect([]);
    }

    /**
     * Ativa a validação em tempo real do arquivo
     */
    public function updatedImportFile()
    {
        $this->validate();
    }

    /**
     * Realiza a validação e carregamento dos lotes no estado...
     */
    public function importLots()
    {
        $this->resetErrorBag();

        $this->validate();

        // Salvar o arquivo importado
        $filePath = Storage::path($this->importFile->store('imports'));

        // Valida os cabeçalhos
        if ($this->validateFileHeadings($filePath)) {
            // Realizar a importação
            $import = new LotsSheetImport;
            $import->import($filePath);
            $this->lots = $import->getRows();
        }

    }

    public function saveLots()
    {
        // Exibe a tela de loading
        $this->showLoading = true;

        // Inicia uma transaction
        \DB::beginTransaction();

        // Salva os lotes
        try {
            foreach ($this->lots as $lotRow) {

                // Verifica se o lote já existe
                $lot = $this->allotment
                    ->lots()
                    ->where('block', $lotRow['block'])
                    ->where('number', $lotRow['number'])
                    ->first();

                /**
                 * Se o lote ja existir, testa se a opção de sobrescrever
                 * está ativa.
                 * Caso a opção estiver ativa: Atualiza o lote com os dados do arquivo
                 * Caso a opção estiver inativa: apenas ignora e passa para o próximo lote
                 *
                 * Se o lote não existir, cria-o com o status definido no arquivo.
                 */
                if ($lot) {
                    if ($this->shouldOverwrite) {
                        $lot->update($this->getFillableLotAttributes($lotRow));
                    } else {
                        continue;
                    }
                } else {
                    $this->allotment->createLot(
                        new Lot($this->getFillableLotAttributes($lotRow)),
                        $lotRow['status']
                    );
                }
            }
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }

        // Termina a transaction
        \DB::commit();

        // Redireciona
        $this->successAction(
            'Lotes importados.',
            ['lots.index', $this->allotment->id],
        );

    }

    /**
     * Realiza a validação do cabeçalho do arquivo
     *
     * @param string $path
     * @return bool
     */
    protected function validateFileHeadings(string $path)
    {
        $headings = (new HeadingRowImport)->toCollection($path)->flatten();
        $validHeadings = collect([
            'quadra', 'lote', 'preco', 'frente',
            'fundos', 'direita', 'esquerda', 'conf_frente',
            'conf_fundos', 'conf_direita', 'conf_esquerda', 'status'
        ]);

        $diff = $validHeadings->diff($headings);

        if ($diff->isNotEmpty()) {
            $this->addError('headings', 'O cabeçalho do arquivo Excel não é válido. Verifique');
            return false;
        }

        return true;
    }

    /**
     * Extrai os campos preenchíveis do array para o model.
     *
     * @param array $lotRow
     * @return array
     */
    protected function getFillableLotAttributes(array $lotRow)
    {
        return [
            'block' => $lotRow['block'],
            'number' => $lotRow['number'],
            'price' => $lotRow['price'],
            'front' => $lotRow['front'],
            'back' => $lotRow['back'],
            'right' => $lotRow['right'],
            'left' => $lotRow['left'],
            'front_side' => $lotRow['front_side'],
            'back_side' => $lotRow['back_side'],
            'right_side' => $lotRow['right_side'],
            'left_side' => $lotRow['left_side']
        ];
    }

    /**
     * Renderiza o componente
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.lots-import');
    }
}
