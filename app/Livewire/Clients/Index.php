<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use App\Models\Client;

class Index extends Component
{

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 4;
    public $statusFilter = 'all';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function changeStatus($clientId)
    {
        $client = Client::findOrFail($clientId);
        $client->update(['status' => !$client->status]);

        session()->flash('message', 'Estado del cliente actualizado correctamente.');
    }

    public function deleteClient(Client $client)
    {
        $client->delete();
        session()->flash('success', 'Cliente eliminado exitosamente.');
    }

    public function render()
    {
        return view('livewire.clients.index', [
            'clients' => Client::query()
                ->when($this->search, function ($query) {
                    $query->where(function($q) {
                        $q->where('name', 'like', '%'.$this->search.'%')
                          ->orWhere('email', 'like', '%'.$this->search.'%')
                          ->orWhere('phone', 'like', '%'.$this->search.'%');
                    });
                })
                ->when($this->statusFilter === 'active', fn($q) => $q->where('status', true))
                ->when($this->statusFilter === 'inactive', fn($q) => $q->where('status', false))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
