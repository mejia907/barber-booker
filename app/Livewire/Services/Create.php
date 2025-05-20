<?php

namespace App\Livewire\Services;

use App\Models\Category;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name, $description, $duration, $price, $image, $categories, $category_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:1',
        'duration' => 'required|numeric|min:1',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:1024',
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function save()
    {

        $this->price = (int) str_replace('.', '', $this->price);

        $this->validate();

        $imagePath = $this->image ? $this->image->store('services', 'public') : null;

        Service::create([
            'name' => $this->name,
            'description' => $this->description,
            'duration' => $this->duration,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'image' => $imagePath,
            'status' => true
        ]);

        session()->flash('success', 'Servicio creado exitosamente.');
        return redirect()->route('services.index');
    }

    public function render()
    {
        return view('livewire.services.create');
    }
}
