<?php


namespace App\Http\Livewire;


trait RedirectHandler
{
    public function successAction(string $message, array $route, bool $redirect = true)
    {
        $this->successMessage = $message;

        if ($redirect) {
            session()->flash('successMessage', $this->successMessage);
            return redirect()->route($route[0], $route[1] ?? null);
        }
    }
}
