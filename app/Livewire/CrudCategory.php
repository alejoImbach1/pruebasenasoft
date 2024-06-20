<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Locked;
use Livewire\Component;

class CrudCategory extends Component
{
    #[Locked]
    public $id;

    public $name;

    public $color;
    public $editOrCreateDisplayed;
    public $deleteDisplayed;

    public $categories;

    public function mount(){
        $this->id = null;
        $this->editOrCreateDisplayed = false;
        $this->deleteDisplayed = false;
        $this->name = '';
        $this->color = '';
        $this->categories = Category::all();
    }

    public function editOrCreate($category = null)
    {
        $this->mount();
        $this->editOrCreateDisplayed = true;
        if($category !== null){
            $this->fill((new Category($category))->only(['name', 'color']));
            $this->id = $category['id'];
        }
    }

    public function updateOrStore()
    {
        $this->validate(
            [
                'name' => 'required|max:100|regex:/^[\p{L}\p{N}\sñÑáéíóúÁÉÍÓÚüÜ]+$/u',
                'color' => 'required|hex_color'
            ],
        );
        // dd($this->id);
        Category::updateOrCreate($this->only('id'), $this->only(['name', 'color']));
        $this->editOrCreateDisplayed = false;
        $this->mount();
    }

    public function dialogDestroy(Category $category)
    {
        $this->deleteDisplayed = true;
        $this->name = $category->name;
        $this->id = $category->id;
    }

    public function destroy()
    {
        Category::destroy($this->id);
        $this->deleteDisplayed = false;
        session()->flash('success','Se eliminó correctamente');
        return redirect()->route('categories.index');
        // $this->mount();
        // $this->dispatch('alert-sent', type: 'warning', message: 'Se eliminó la información de contacto');
    }

    public function cancelDestroy()
    {
        $this->deleteDisplayed = false;
        $this->mount();
    }
    public function render()
    {
        return view('livewire.crud-category');
    }
}
