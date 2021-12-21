<?php

namespace App\Http\Livewire\Proposal;

use App\Models\Lot;
use App\Models\Proposal;
use App\Models\ProposalDocument;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class DocumentStep extends Component
{
    use WithFileUploads;

    public $proposal;

    /**
     * A lista de documentos para envio da proposta
     *
     * @var mixed
     */
    public $documents = [];

    /**
     * A lista de documentos para envio da proposta
     *
     * @var mixed
     */
    public $paths = [];

    /**
     * Event listeners
     *
     * @var string[]
     */
    protected $listeners = [
        'reportData' => 'sendData',
        'documentRemoved' => 'render'
    ];

    public function mount(Lot $lot, Proposal $proposal)
    {
        $this->lot = $lot;
        $this->proposal = $proposal;
    }

    public function sendData()
    {
        $this->validate(
            [
                'documents' => ['required'],
                'documents.*' => ['mimes:jpg,png,pdf']
            ],
            [
                'documents.required' => 'Adicione os arquivos de documentos.',
                'documents.*.mimes' => 'Os documentos devem ser dos tipos JPG, PNG ou PDF.'
            ]
        );

        // Salva os documentos da proposta
        /** @var TemporaryUploadedFile $document */
        foreach ($this->documents as $document) {
            $filename = $document->store('/', 'documents');
            $this->paths[] = $filename;
        }

        $this->emitUp('documentsData', $this->paths);
    }

    public function deleteDocument(ProposalDocument $document)
    {
        $document->delete();
        $this->emit('documentRemoved');
    }

    public function render()
    {
        return view('livewire.proposal.document-step');
    }
}
