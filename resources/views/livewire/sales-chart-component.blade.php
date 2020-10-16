<x-card
    class="mt-4 relative"
    wire:init="getChartData"
    x-data="salesChart()"
    x-init="initChart($refs.chartCanvas)"
    x-on:sales-chart-data-loaded.window="updateChart($event.detail)"
>
    <div class="p-4 border-b flex items-center justify-between">
        <h2 class="font-bold text-lg">Vendas totais por competência (em R$)</h2>
        <x-button wire:click="getChartData" @click="toggleLoading">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
        </x-button>
    </div>
    <div
        x-show.transition.opacity.duration.500ms="loading"
        class="p-4 absolute inset-y-0 w-full text-white bg-black bg-opacity-75 flex items-center justify-center"
    >
        <svg class="animate-spin -ml-1 mr-3 h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="font-medium">Carregando dados do gráfico...</span>
    </div>
    <div class="p-4">
        <canvas
            class="w-full"
            height="400"
            x-ref="chartCanvas"
            wire:ignore
        ></canvas>
    </div>
    @push('scripts')
        <script>
            window.salesChart = () => {
                return {
                    loading: true,
                    chart: null,
                    config: {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                            datasets: [
                                {
                                    label: 'Faturamento',
                                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                                    borderWidth: 3,
                                    borderColor: 'rgba(245, 134, 52, 1)',
                                    backgroundColor: 'rgba(245, 134, 52, 0.5)'
                                }
                            ],
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    },

                    initChart(chartCanvas) {
                        this.chart = new Chart(chartCanvas.getContext('2d'), this.config);
                    },

                    toggleLoading() {
                        this.loading = !this.loading;
                    },

                    updateChart(chartData) {
                        this.chart.data.datasets[0].data = chartData;
                        this.chart.update();
                        this.toggleLoading();
                    }
                }
            }
        </script>
    @endpush
</x-card>
