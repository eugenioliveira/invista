<?php

namespace App\Http\Livewire;

use App\Actions\Map\UpdateMap;
use App\Models\Allotment;
use App\Models\Map;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditMapForm extends Component
{
    use WithFileUploads, RedirectHandler;

    /**
     * O loteamento a qual o mapa pertence (ou pertencerá)
     *
     * @var Allotment
     */
    public Allotment $allotment;

    /**
     * O nova imagem de fundo do mapa.
     *
     * @var mixed
     */
    public $image;

    /**
     * Url do arquivo temporário.
     *
     * @var string|null
     */
    public ?string $tempUrl = null;

    /**
     * Regras de validação
     *
     * @var array
     */
    protected array $rules = [
        'state.name' => ['required', 'min:5'],
        'state.description' => ['nullable', 'min:5'],
        'image' => ['nullable', 'sometimes', 'image', 'max:100000'],
    ];

    /**
     * Mensagens de erro
     *
     * @var array
     */
    protected array $messages = [
        'image.image' => 'O arquivo deve ser uma imagem.',
        'image.max' => 'Arquivo muito grande! Envie um arquivo com menos de 100MB.',
    ];

    /**
     * Os campos do mapa
     *
     * @var array
     */
    public array $state;

    /**
     * Indica que os campos serão validados em tempo real
     *
     * @param $propertyName
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedImage()
    {
        try {
            $this->tempUrl = $this->image->temporaryUrl();
        } catch (\Exception $e) {
            $this->tempUrl = null;
        }
    }

    /**
     * Monta o componente
     *
     * @param Allotment $allotment
     * @return void
     */
    public function mount(Allotment $allotment)
    {
        $this->allotment = $allotment;
        $this->state = $allotment->map instanceof Map
            ? $allotment->map->toArray()
            : ['name' => '', 'image' => '', 'description' => '', 'bounds' => ''];
    }

    /**
     * Recebe os dados do formulário e salva o mapa.
     *
     * @param bool $redirectAfterSave
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(UpdateMap $updater, bool $redirectAfterSave = true)
    {
        $this->validate();

        $this->state['image'] = ($this->image) ? $this->image->store('/', 'maps') : $this->state['image'];

        $updater->create($this->allotment, $this->state);

        // Redireciona
        $this->successAction(
            'Mapa Salvo.',
            ['allotments.index'],
            $redirectAfterSave
        );
    }

    public function render()
    {
        return view('livewire.edit-map-form');
    }
}
