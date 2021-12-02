<div
        x-data="{ loading: false }"
        x-show="loading"
        @loading.window="loading = $event.detail.loading"
>
    <div class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
        <h2 class="text-center text-white dark:text-fuchsia-600 text-xl font-semibold">Loading....</h2>
    </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    this.livewire.hook('message.sent', () => {
      window.dispatchEvent(
        new CustomEvent('loading', { detail: { loading: true } })
      );
    });
    this.livewire.hook('message.processed', (message, component) => {
      window.dispatchEvent(
        new CustomEvent('loading', { detail: { loading: false } })
      );
    });
  });
</script>