<?php

namespace App\Http\Livewire;

use App\Imports\LotImport;
use App\Models\Allotment;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\HeadingRowImport;
use Storage;
use Validator;

class LotsImport extends Component
{
    use WithFileUploads;

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
            $import = new LotImport;
            $import->import($filePath);
            $this->lots = $import->getRows();
        }

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
     * Renderiza o componente
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.lots-import');
    }
}
