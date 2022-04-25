<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Livewire\WithPagination;

use DB;

class PermisosController extends Component
{
    use WithPagination;
    public $permissionName, $search, $selected_id, $pageTitle, $componentName, $pagination;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName= 'Permisos';
    }

    public function render()
    {
        if(strlen($this->search)>0){
            $permisos =  Permission::where('name', 'like', '%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $permisos =  Permission::orderBy('id' , 'asc')->paginate($this->pagination);

        }

        return view('livewire.permisos.component', ['permisos' => $permisos])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function CreatePermission()
    {
        $rules = [
            'permissionName' => 'required|unique:permissions,name|min:3|regex:/^[\pL\s\-_]+$/u'
        ];

        $messages = [
            'permissionName.required' => 'El nombre del permiso es requerido',
            'permissionName.unique' => 'El permiso ya existe',
            'permissionName.min' => 'El nombre debe tener al menos 3 caracteres',
            'permissionName.regex' => 'Solo se aceptan letras y espacios',

        ];
        $this->validate($rules,  $messages);

        Permission::create(['name' => $this->permissionName]);
        $this->emit('permiso-added', 'Se registro el perniso con éxito');
        $this->resetUI();
    }

    public function Edit($id)
    {
        $permiso = Permission::find($id);

        $this->permissionName = $permiso->name;
        $this->selected_id = $permiso->id;
        $this->emit('show-modal', 'Show modal');
    }

    public function UpdatePermission()
    {
        $rules = [
            'permissionName' => "required|unique:permissions,name, {$this->selected_id}|min:3|regex:/^[\pL\s\-_]+$/u"
        ];

        $messages = [
            'permissionName.required' => 'El nombre del permiso es requerido',
            'permissionName.unique' => 'El permiso ya existe',
            'permissionName.min' => 'El nombre debe tener al menos 3 caracteres',
            'permissionName.regex' => 'Solo se aceptan letras y espacios',

        ];

        $this->validate($rules, $messages);

        $permiso = Permission::find($this->selected_id);
        $permiso->name=$this->permissionName;
        $permiso->save();


        $this->emit('permiso-updated', 'Permiso Actualizada');
        $this->resetUI();
    }

    protected $listeners = [
        'destroy' => 'Destroy'
    ];

    public function Destroy($id)
    {
        $rolesCount = Permission::find($id)->getRoleNames()->count();

        if($rolesCount>0){
            $this->emit('permiso-error', 'No se puede eliminar el registro porque tiene roles asociados');
            return;
        }

        Permission::find($id)->delete();
        $this->emit('permiso-deleted', 'Se elimino el permiso con exito');

        $this->resetUI();
    }

    public function resetUI()
    {
        $this->permissionName='';
        $this->search='';
        $this->selected_id=0;
        $this->resetValidation();
        $this->resetPage();
    }

}
