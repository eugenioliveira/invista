<div>
    <div wire:ignore id="map" class='min-w-screen min-h-screen'>

    </div>

    @push('scripts')
        <script>
          // Inicializa o mapa
          const map = new MapLots('map', '{{ Storage::disk('maps')->url($map->image) }}', {{ \Illuminate\Support\Js::from($map->bounds) }});
          // Carrega os marcadores pela primeira vez
          map.addGroup();
          addMarkers(map);
          // Inicializa o updater, caso o mapa não esteja em modo de edição
          if (@this.edit === false) {
            let poll = setInterval(addMarkers, 5000, map);
          }
          // Adiciona os marcadores ao mapa
          function addMarkers(map) {
            map.removeGroup();
            map.addGroup();
            @this.getMarkers();
            let markers = @this.mapMarkers;
            markers.forEach((marker) => {
              map.addCircle(marker.id, marker.position, marker.color, 10, marker.popup, marker.draggable);
            });
          }

          window.addEventListener('circle-dragged', (e) => {
            @this.updateMarker(e.detail);
          });

        </script>
    @endpush
</div>