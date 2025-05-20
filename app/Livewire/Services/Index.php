<?php

namespace App\Livewire\Services;

use App\Models\Service;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $perPage = 6;
    public $statusFilter = 'all';

    public function changeStatus($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $service->status = !$service->status;

        if ($service->save()) {
            $message = $service->status
                ? 'El servicio ha sido activado correctamente.'
                : 'El servicio ha sido desactivado correctamente.';

            session()->flash('success', $message);
        } else {
            session()->flash('error', 'No se pudo actualizar el estado del servicio.');
        }
    }

    public function render()
    {
        return view('livewire.services.index', [
            'services' => Service::query()
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->statusFilter === 'active', fn($q) => $q->where('status', true))
                ->when($this->statusFilter === 'inactive', fn($q) => $q->where('status', false))
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage)
        ]);
    }
}
