<?php

namespace App\Http\Livewire;

use App\Imports\LotImport;
use App\Models\Allotment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

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
     * Realiza a importação dos lotes.
     */
    public function importLots()
    {
        $this->resetErrorBag();

        $this->validate();

        // Salvar o arquivo importado
        $file = $this->importFile->store('imports');

        // Realizar a importação
        $import = new LotImport();
        $import->import(Storage::path($file));
        $this->lots = $import->getRows();
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
