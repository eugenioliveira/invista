<div
        x-data="{ show: @entangle($attributes->wire('model')) }"
        x-show="show"
        style="display: none"
>
    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            {{--
              Background overlay, show/hide based on slide-over state.
    
              Entering: "ease-in-out duration-500"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in-out duration-500"
                From: "opacity-100"
                To: "opacity-0"
            --}}
            <div
                    class="absolute inset-0 bg-orange-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                    x-show="show"
                    x-transition:enter="ease-in-out duration-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in-out duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
            ></div>
            <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex" aria-labelledby="slide-over-heading">
                {{--
                  Slide-over panel, show/hide based on slide-over state.
    
                  Entering: "transform transition ease-in-out duration-500 sm:duration-700"
                    From: "translate-x-full"
                    To: "translate-x-0"
                  Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
                    From: "translate-x-0"
                    To: "translate-x-full"
                --}}
                <div
                        class="relative w-screen max-w-md"
                        x-show="show"
                        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:enter-start="translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="translate-x-full"
                >
                    {{--
                      Close button, show/hide based on slide-over state.
    
                      Entering: "ease-in-out duration-500"
                        From: "opacity-0"
                        To: "opacity-100"
                      Leaving: "ease-in-out duration-500"
                        From: "opacity-100"
                        To: "opacity-0"
                    --}}
                    <div
                            class="absolute transition-opacity top-0 left-0 -ml-8 pt-4 pr-2 flex sm:-ml-10 sm:pr-4"
                            x-show="show"
                            x-transition:enter="ease-in-out duration-500"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in-out duration-50"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                    >
                        <button class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" @click="show = false">
                            <span class="sr-only">Fechar</span>
                            {{-- Heroicon name: outline/x --}}
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                        <div class="px-4 sm:px-6">
                            <h2 id="slide-over-heading" class="text-lg font-medium text-gray-900">
                                {{ $title }}
                            </h2>
                        </div>
                        <div class="mt-6 relative flex-1 px-4 sm:px-6">
                            {{-- Replace with your content --}}
                            {{ $body }}
                            {{-- /End replace --}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>