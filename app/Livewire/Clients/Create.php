<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;

class Create extends Component
{
    public string $name;
    public string $email;
    public string $phone;

    protected function rules(){
        return [
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
        ];
    }

    public function save(){
        $validated = $this->validate();
        Client::create($validated);
        session()->flash('success', 'Cliente creado exitosamente.');
        
        $this->dispatch('show-success-message');

        return redirect()->route('clients.index');
    }

    public function render()
    {
        return view('livewire.clients.create');
    }
}
