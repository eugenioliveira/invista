<?php

namespace App\Http\Livewire;

use App\Models\Allotment;
use App\Models\City;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * Formulário do loteamento.
 *
 * Class AllotmentForm
 * @package App\Http\Livewire
 */
class AllotmentForm extends Component
{
    use WithFileUploads;
    use RedirectHandler;

    /**
     * O loteamento a ser salvo.
     *
     * @var Allotment
     */
    public Allotment $allotment;

    /**
     * O nova foto de capa do Loteamento.
     *
     * @var mixed
     */
    public $cover;


    /**
     * Url do arquivo temporário.
     *
     * @var string|null
     */
    public ?string $tempUrl = null;

    /**
     * A lista de cidades cadastradas.
     *
     * @var mixed
     */
    public $cities;

    /**
     * Event listeners
     *
     * @var string[]
     */
    protected $listeners = ['cityAdded' => 'getCities'];

    /**
     * Regras de validação
     *
     * @var array
     */
    protected array $rules = [
        'allotment.title' => ['required', 'min:6'],
        'cover' => ['nullable', 'sometimes', 'image', 'max:5000'],
        'allotment.city_id' => ['required', 'numeric'],
        'allotment.active' => ['required'],
        'allotment.area' => ['required', 'regex:/^[1-9]\d*(\,\d{1,2})?$/'],
        'allotment.latitude' => ['nullable', 'numeric'],
        'allotment.longitude' => ['nullable', 'numeric'],
        'allotment.max_discount' => ['required', 'regex:/^\d*(\,\d{1,2})?$/'],
        'allotment.allowable_margin' => ['required', 'regex:/^\d*(\,\d{1,2})?$/'],
        'allotment.assurance_parcels' => ['required', 'integer'],
        'allotment.reservation_duration' => ['required', 'numeric', 'gt:0'],
    ];

    /**
     * Mensagens de erro
     *
     * @var array
     */
    protected array $messages = [
        'cover.image' => 'O arquivo deve ser uma imagem.',
        'cover.max' => 'Arquivo muito grande! Envie um arquivo com menos de 5MB.',
        'allotment.title.required' => 'O campo Título é obrigatório.',
        'allotment.title.min' => 'O campo Título é deve conter pelo menos 6 caracteres.',
        'allotment.city_id.required' => 'Selecione uma cidade.',
        'allotment.city_id.numeric' => 'Selecione uma cidade.',
        'allotment.area.required' => 'O campo área total é obrigatório.',
        'allotment.area.regex' => 'O campo área total deve ser um número maior que zero.',
        'allotment.max_discount.required' => 'O campo Desconto permitido é obrigatório.',
        'allotment.max_discount.regex' => 'O campo Desconto permitido deve ser numérico.',
        'allotment.allowable_margin.required' => 'O campo Margem máxima de desconto é obrigatório.',
        'allotment.allowable_margin.regex' => 'O campo Margem máxima de desconto deve ser numérico.',
        'allotment.assurance_parcels.required' => 'O campo Parcelamento máximo do arras é obrigatório.',
        'allotment.assurance_parcels.numeric' => 'O campo Parcelamento máximo do arras deve ser numérico.',
        'allotment.reservation_duration.required' => 'O campo Duração da reserva é obrigatório.',
        'allotment.reservation_duration.numeric' => 'O campo Duração da reserva deve ser numérico.',
        'allotment.reservation_duration.gt' => 'O campo Duração da reserva deve ser maior que zero.',
    ];

    /**
     * Prepara o componente.
     *
     * @param Allotment $allotment
     */
    public function mount(Allotment $allotment)
    {
        $this->getCities();
        $this->allotment = $allotment;
        $this->allotment->active = 1;
    }

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

    public function updatedCover()
    {
        try {
            $this->tempUrl = $this->cover->temporaryUrl();
        } catch (\Exception $e) {
            $this->tempUrl = null;
        }
    }

    /**
     * Recebe os dados do formulário e salva o loteamento.
     *
     * @param bool $redirectAfterSave
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(bool $redirectAfterSave = true)
    {
        $this->validate();

        $this->allotment->cover = ($this->cover) ? $this->cover->store('covers', 'public') : $this->allotment->cover;

        $this->allotment->save();

        // Redireciona
        $this->successAction(
            'Loteamento Salvo.',
            ['allotments.index'],
            $redirectAfterSave
        );
    }

    /**
     * Obtem a lista de cidades.
     * Caso ela tenha sido recém criada, seleciona-a.
     *
     * @param null $selectedCity
     * @return void
     */
    public function getCities($selectedCity = null)
    {
        $this->cities = City::orderBy('name')->get();

        if ($selectedCity) {
            $this->allotment->city_id = $selectedCity;
        }
    }

    public function render()
    {
        return view('livewire.allotment-form');
    }
}
