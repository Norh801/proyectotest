<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoriesController extends Component
{

    use WithPagination;

    public $name, $search, $selected_id, $pageTitle, $componentName, $orderby, $orderAsc;
    public $pagination = 5;


    public function mount()
    {
        $this->pageTitle= 'Listado';
        $this->componentName='Categorias';
        $this->orderby='id';
        $this->orderAsc='true';

    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search)>0){
            $data =  Category::where('name', 'like', '%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $data =  Category::orderBy($this->orderby, $this->orderAsc ? 'asc' : 'desc')->paginate($this->pagination);

        }

        return view('livewire.category.categories', ['categories' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id)
    {
        $record = Category::find($id, ['id', 'name']);

        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->emit('show-modal', 'show modal');
    }

    public function Store()
    {
        $rules = [
            'name' => 'required|unique:categories|min:3|regex:/^[\pL\s\-]+$/u'
        ];

        $messages = [
            'name.required' => 'El nombre de la categoria es requerido',
            'name.unique' => 'La categoria ya existe',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.regex' => 'Solo se aceptan letras y espacios',

        ];

        $this->validate($rules, $messages);

        $category = Category::create([
            'name' => $this->name,
        ]);

        $this->resetUI();
        $this->emit('category-added', 'Categoria Registrada');
    }

    public function Update()
    {
        $rules = [
            'name' => 'required|unique:categories|min:3|regex:/^[\pL\s\-]+$/u'
        ];

        $messages = [
            'name.required' => 'El nombre de la categoria es requerido',
            'name.unique' => 'La categoria ya existe',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.regex' => 'Solo se aceptan letras y espacios',

        ];

        $this->validate($rules, $messages);

        $category = Category::find($this->selected_id);
        $category->update([
            'name' => $this->name,
        ]);

        $this->resetUI();
        $this->emit('category-updated', 'Categoria Actualizada');
    }




    public function resetUI()
    {
        $this->name='';
        $this->search='';
        $this->selected_id=0;
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Category $category)
    {
        //$category = Category::find($id);
        //dd($category);
        if ($category != null) {
            $category->delete();
        }

        $this->resetUI();
        $this->emit('category-deleted', 'Categoria Eliminada');
    }
}
