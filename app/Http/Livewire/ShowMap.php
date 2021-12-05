<?php

namespace App\Http\Livewire;

use App\Actions\Map\SyncMarkers;
use App\Models\Map;
use App\Models\Marker;
use Livewire\Component;

class ShowMap extends Component
{
    public Map $map;

    public array $mapMarkers = [];

    public bool $edit = false;

    protected $queryString = ['edit' => ['except' => false]];

    public function mount(Map $map)
    {
        $this->map = $map;
        $this->syncMarkers();
        $this->getMarkers();
    }

    /**
     * Sincroniza os marcadores do mapa.
     *
     * @return void
     */
    public function syncMarkers()
    {
        (new SyncMarkers())->sync($this->map);
    }

    /**
     * Escuta o evento de atualização da posição de um marcador.
     *
     * @param $marker
     * @return void
     */
    public function updateMarker($markerInfo)
    {
        $marker = Marker::findOrFail($markerInfo['id']);
        $marker->update([
            'position' => [$markerInfo['lat'], $markerInfo['lng']]
        ]);
    }

    public function getMarkers()
    {
        $popupHtml = <<<EOT
            <strong>Lote: </strong>%s<br/>
            <strong>Preço: </strong>%s<br/>
            <strong>Status: </strong>%s<br/>
EOT;

        $markers = $this->map->markers()->with(
            ['lot', 'lot.latestStatus', 'lot.activeReservation', 'lot.activeProposal']
        )->get();

        $draggable = $this->edit && \Auth::user()->can('edit_allotment');
        $mapMarkers = collect([]);
        foreach ($markers as $marker) {
            $mapMarkers->push((object)[
                'id' => $marker->id,
                'position' => $marker->position,
                'color' => $marker->lot->latestStatus->type->color(),
                'popup' => sprintf(
                    $popupHtml,
                    $marker->lot->identification,
                    $marker->lot->formatted_price,
                    $marker->lot->getStatus()->type->description
                ),
                'draggable' => $draggable
            ]);
        }

        $this->mapMarkers = $mapMarkers->toArray();
    }

    public function render()
    {
        return view('livewire.show-map');
    }
}
