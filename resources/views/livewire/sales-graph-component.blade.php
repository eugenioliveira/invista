<x-card class="mt-4 p-4">
    <canvas
        id="sales-graph"
        class="w-full"
        height="400"
        x-data="salesGraph()"
        x-init="initGraph($el)"
    ></canvas>
    @push('scripts')
        <script>
            let salesGraph = () => {
                return {
                    options: {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                            datasets: [
                                {
                                    label: 'Faturamento',
                                    data: {{ $graphData }},
                                    borderWidth: 3,
                                    borderColor: 'rgba(245, 134, 52, 1)',
                                    backgroundColor: 'rgba(245, 134, 52, 0.5)'
                                }
                            ]
                        }
                    },

                    initGraph(canvas) {
                        new Chart(canvas.getContext('2d'), this.options)
                    }
                }
            }
        </script>
    @endpush
</x-card>
