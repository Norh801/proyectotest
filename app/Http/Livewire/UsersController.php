<?php

namespace App\Http\Livewire;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Sale;


class UsersController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $phone, $email, $status, $selected_id, $password, $image, $fileLoaded, $profile;
    public $pageTitle, $componentName, $search, $pagination;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle='Listado';
        $this->componentName='Usuarios';
        $this->status='Elegir';
    }

    public function render()
    {
        if(strlen($this->search) >0){
            $data = User::where('name', 'like', '%' .$this->search. '%')
            ->select('*')->orderBy('name', 'asc')->paginate($this->pagination);
        }else{
            $data = User::join('roles as r', 'r.id', 'users.profile')
            ->select('users.*', 'r.name as profile')
            -> orderBy('users.name', 'asc')
            ->paginate($this->pagination);
        }


        return view('livewire.users.component', [
            'data' => $data,
            'roles' => Role::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function resetUI()
    {
        $this->name='';
        $this->email='';
        $this->password='';
        $this->phone='';
        $this->image='';

        $this->search='';
        $this->status='Elegir';
        $this->selected_id=0;
        $this->resetValidation();
        $this->resetPage();
    }

    public function Edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->phone  =$user->phone;
        $this->profile = $user->profile;
        $this->status=$user->status;
        $this->email = $user->email;
        $this->password = '';
        $this->emit('show-modal', "Open!");
    }

    protected $listeners = [
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'
    ];

    public function Store()
    {
        $rules = [
            'name' => 'required|min:3|regex:/^[\pL\s0-9\-]+$/u',
            'email' => 'required|unique:users|email',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:5',
        ];

        $messages = [
            'name.required' => 'El nombre del usuario es requerido',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.regex' => 'Solo se aceptan letras y espacios',

            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya registrado',
            'email.email' => 'Ingrese email valido',
            'status.required' => 'El estatus es requerido',
            'profile.required' => 'Seleccionar el perfil/rol del usuario',
            'password.required' => 'La contraseña es requerido',
            'password.min' => 'La contraseña debe tener al menos 5 caracteres',
        ];

        $this->validate($rules, $messages);


        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,

            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password),
        ]);


        $user->syncRoles($this->profile);

        if($this->image)
        {
            $customFileName = uniqid().' _.'.$this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $user->image = $customFileName;
            $user->save();
        }



        $this->resetUI();
        $this->emit('user-added', 'Usuario registrado');
    }

    public function Update()
    {
        $rules = [
            'email' => "required|email|unique:users,email,{$this->selected_id}",
            'name' => 'required|min:3|regex:/^[\pL\s0-9\-]+$/u',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:5',
        ];

        $messages = [
            'name.required' => 'El nombre del usuario es requerido',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.regex' => 'Solo se aceptan letras y espacios',

            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya registrado',
            'email.email' => 'Ingrese email valido',
            'status.required' => 'El estatus es requerido',
            'profile.required' => 'Seleccionar el perfil/rol del usuario',
            'password.required' => 'La contraseña es requerido',
            'password.min' => 'La contraseña debe tener al menos 5 caracteres',
        ];

        $this->validate($rules, $messages);

        $user = User::find($this->selected_id);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,

            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password),
        ]);

        $user->syncRoles($this->profile);

        if($this->image)
        {
            $customFileName = uniqid().' _.'.$this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $imageTemp = $user->image;
            $user->image = $customFileName;
            $user->save();

            if($imageTemp != null){
                if(file_exists('storage/users/'. $imageTemp)){
                    unlink('storage/users/'. $imageTemp);
                }
            }
        }

        $this->resetUI();
        $this->emit('user-updated', 'Usuario actualizado');
    }


    public function destroy(User $user)
    {
        if($user){
            $sales = Sale::where('user_id', $user->id)->count();
            if($sales > 0){
                $this->emit('user-withsales', 'No es posible eliminar el usuario porque tiene ventas registradas');

            }else{
                $user -> delete();
                $this->emit('user-deleted', 'Usuario eliminado');
            }
        }
    }

}
