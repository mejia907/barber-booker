<?php

namespace App\Livewire\Services;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;

    public Service $service;
    public string $name = '';
    public string $description = '';
    public string $duration = '';
    public string $price = '';
    public string $category_id = '';
    public string $imagePath;
    public $image;
    public $categories = [];


    public function mount(Service $service)
    {
        $this->service = $service;
        $this->name = $service->name;
        $this->description = $service->description;
        $this->duration = $service->duration;
        $this->price = $service->price;
        $this->category_id = $service->category_id;
        $this->imagePath = $service->image;

        $this->categories = Category::all();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:1',
            'duration' => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:1024',
        ];
    }
    public function update()
    {
        $this->price = (int) str_replace('.', '', $this->price);

        $this->validate();

        if ($this->image) {
            // Eliminar imagen anterior si existe
            if ($this->service->image && Storage::disk('public')->exists($this->service->image)) {
                Storage::disk('public')->delete($this->service->image);
            }

            // Guardar nueva imagen
            $path = $this->image->store('services', 'public');
            $this->service->image = $path;
        }
        
        $this->service->name = $this->name;
        $this->service->description = $this->description;
        $this->service->duration = $this->duration;
        $this->service->price = $this->price;
        $this->service->category_id = $this->category_id;
        $this->service->save();

        session()->flash('success', 'Servicio actualizado exitosamente.');
        return redirect()->route('services.index');
    }


    public function render()
    {
        return view('livewire.services.edit');
    }
}
