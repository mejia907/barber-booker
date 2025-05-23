<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $perPage = 6;
    public $statusFilter = 'all';

    public function render()
    {
        return view('livewire.employees.index', [
            'employees' => Employee::with('specialty')
                ->when(
                    $this->search,
                    fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                )
                ->when($this->statusFilter === 'active', fn($q) => $q->where('status', true))
                ->when($this->statusFilter === 'inactive', fn($q) => $q->where('status', false))
                ->orderBy('name')
                ->paginate($this->perPage),
        ]);
    }
}
