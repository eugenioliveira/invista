<div
        x-data="salesChart()"
        x-init="initChart($refs.chartCanvas)"
        wire:init="getChartData"
        x-on:sales-chart-data-loaded.window="updateChart($event.detail)"
>
    <x-card class="mt-4 relative pb-6">
        <div class="p-4 border-b flex items-center justify-between">
            <h2 class="font-bold text-lg">Vendas totais por competência (em R$)</h2>
            <x-button wire:click="getChartData" x-on:click="toggleLoading">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </x-button>
        </div>

        <div
                x-show="loading"
                x-transition:enter="transition opacity ease-out duration-500"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-75"
                x-transition:leave="transition opacity ease-in duration-500"
                x-transition:leave-start="opacity-75"
                x-transition:leave-end="opacity-0"
                class="p-4 z-20 absolute inset-y-0 w-full text-white bg-black bg-opacity-75 flex items-center justify-center"
        >
            <svg class="animate-spin mr-3 h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="font-medium">Carregando dados do gráfico...</span>
        </div>

        <div class="p-4">
            <div style="height: 28rem" x-ref="chartCanvas" wire:ignore></div>
        </div>

        <script>
            function salesChart() {
                return {
                    loading: true,
                    chart: null,
                    chartOptions: {
                        chart: {
                            type: 'area',
                            height: '100%'
                        },
                        colors: ['#F58634'],
                        dataLabels: {
                            enabled: false,
                        },
                        series: [{
                            name: 'Faturamento',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                        }],
                        stroke: {
                            curve: 'straight'
                        },
                        yaxis: {
                            labels: {
                                formatter: (value) => new Intl.NumberFormat('pt-BR', {
                                    style: 'currency',
                                    currency: 'BRL'
                                }).format(value)
                            },
                        },
                        xaxis: {
                            categories: [
                                'Janeiro',
                                'Fevereiro',
                                'Março',
                                'Abril',
                                'Maio',
                                'Junho',
                                'Julho',
                                'Agosto',
                                'Setembro',
                                'Outubro',
                                'Novembro',
                                'Dezembro'
                            ]
                        }
                    },

                    initChart(chartCanvas) {
                        this.chart = new ApexCharts(chartCanvas, this.chartOptions);
                        this.chart.render();
                    },

                    toggleLoading() {
                        this.loading = !this.loading;
                    },

                    updateChart(chartData) {
                        this.chart.updateSeries([{data: chartData}]);
                        this.toggleLoading();
                    },

                }
            }
        </script>
    </x-card>
</div>