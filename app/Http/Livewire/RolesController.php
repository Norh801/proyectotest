<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Livewire\WithPagination;

use DB;

class RolesController extends Component
{
    use WithPagination;
    public $roleName, $search, $selected_id, $pageTitle, $componentName, $pagination;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName= 'Roles';
    }

    public function render()
    {
        if(strlen($this->search)>0){
            $roles =  Role::where('name', 'like', '%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $roles =  Role::orderBy('name' , 'asc')->paginate($this->pagination);

        }

        return view('livewire.roles.component', ['roles' => $roles])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function CreateRole()
    {
        $rules = [
            'roleName' => 'required|unique:roles,name|min:3|regex:/^[\pL\s\-]+$/u'
        ];

        $messages = [
            'roleName.required' => 'El nombre del rol es requerido',
            'roleName.unique' => 'El rol ya existe',
            'roleName.min' => 'El nombre debe tener al menos 3 caracteres',
            'roleName.regex' => 'Solo se aceptan letras y espacios',

        ];
        $this->validate($rules,  $messages);

        Role::create(['name' => $this->roleName]);
        $this->emit('role-added', 'Se registro el role con éxito');
    }

    public function Edit($id)
    {
        $role = Role::find($id);

        $this->roleName = $role->name;
        $this->selected_id = $role->id;
        $this->emit('show-modal', 'Show modal');
    }

    public function UpdateRole()
    {
        $rules = [
            'roleName' => "required|unique:roles,name, {$this->selected_id}|min:3|regex:/^[\pL\s\-]+$/u"
        ];

        $messages = [
            'roleName.required' => 'El nombre del rol es requerido',
            'roleName.unique' => 'El rol ya existe',
            'roleName.min' => 'El nombre debe tener al menos 3 caracteres',
            'roleName.regex' => 'Solo se aceptan letras y espacios',

        ];

        $this->validate($rules, $messages);

        $role = Role::find($this->selected_id);
        $role->name=$this->roleName;
        $role->save();


        $this->emit('role-updated', 'Rol Actualizada');
        $this->resetUI();
    }

    protected $listeners = [
        'destroy' => 'Destroy'
    ];

    public function Destroy($id)
    {
        $permissionsCount = Role::find($id)->permissions->count();
        if($permissionsCount>0){
            $this->emit('role-error', 'No se puede alterar el role porque tiene permisos asociados');
        }
        Role::find($id)->delete();
        $this->emit('role-deleted', 'Se elimino el rol con exito');

        $this->resetUI();
    }

    public function resetUI()
    {
        $this->roleName='';
        $this->search='';
        $this->selected_id=0;
        $this->resetValidation();
        $this->resetPage();
    }

}
