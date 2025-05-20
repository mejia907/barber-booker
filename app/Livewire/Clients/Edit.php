<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;

class Edit extends Component
{
    public Client $client;
    public string $name = '';
    public string $email = '';
    public string $phone = '';

    public function mount(Client $client){
        $this->client = $client;
        $this->name = $client->name;
        $this->email = $client->email;
        $this->phone = $client->phone;
    }

    public function rules(){
        return [
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:clients,email,' . $this->client->id,
            'phone' => 'nullable|string|max:20',
        ];
    }

    public function update(){
        
        $this->validate();

        $this->client->name = $this->name;
        $this->client->email = $this->email;
        $this->client->phone = $this->phone;
        $this->client->save();

        session()->flash('success', 'Cliente actualizado exitosamente.');
        $this->dispatch('show-success-message');

        return redirect()->route('clients.index');
    }

    public function render()
    {
        return view('livewire.clients.edit');
    }
}
