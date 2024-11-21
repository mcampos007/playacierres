<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller {

    public function index() {
        //
        $usuarios = User::paginate( 10 );
        return view( 'admin.users.index', compact( 'usuarios' ) );
    }

    public function create() {
        //
        return view( 'admin.users.create' );
    }

    public function store( Request $request ) {
        //
        // Definir reglas de validación
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'sometimes|string|in:admin,user'
        ];

        // Definir mensajes personalizados
        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico no debe exceder los 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'role.in' => 'El rol debe ser uno de los valores permitidos: admin, user.',
        ];

        // Validar los datos del formulario con mensajes personalizados
        $request->validate( $rules, $messages );

        $data = $request->only( [ 'name', 'email', 'password', 'passwordconfirm', 'role' ] );

        if ( $data[ 'password' ] !== $data[ 'passwordconfirm' ] ) {
            return redirect()->back()->withInput()->with( 'error', 'el password y la confirmación no coinciden!!' );

        }
        $role = $request->has( 'role' ) ? $request->input( 'role' ) : 'user';

        if ( $request->has( 'role' ) ) {
            // El campo 'role' se recibió en la solicitud
            $role = 'admin';
            //$request->input( 'role' );
        } else {
            // El campo 'role' no se recibió en la solicitud
            $role = 'user';
            // Ejemplo de valor predeterminado
        }
        try {

            $usuario = new User();

            $usuario->name = $data[ 'name' ];
            $usuario->email = $data[ 'email' ];
            $usuario->password = bcrypt( $data[ 'password' ] );
            $usuario->role = $role;

            $usuario->save();
            // Redirigir con un mensaje de éxito
            return redirect( '/admin/user' )->with( 'success', '¡Usuario creado exitosamente!' );
        } catch ( \Exception $e ) {
            // Manejar cualquier error durante el proceso de guardado
            return redirect()->back()->withInput()->with( 'error', 'Hubo un problema al crear el usuario: ' . $e->getMessage() );
        }

    }

    public function show( $id ) {
        //
    }

    public function edit( $id ) {
        //
        $usuario = User::findOrFail( $id );
        return view( 'admin.users.edit', compact( 'usuario' ) );
    }

    public function update( Request $request, $id ) {
        //
        $data = $request->only( [ 'name', 'email', 'role' ] );
        $user = User::find( $id );
        $user->name = $data[ 'name' ];
        $user->email = $data[ 'email' ];
        $user->role = $data[ 'role' ];
        $user->save();
        return redirect()->back()->with( 'success', 'Los datos del cliente se actualizaron correctamente!!' );
    }

    public function destroy( $id ) {
        $usuario = User::findOrFail( $id );
        if ( !$usuario ) {
            return redirect()->back()->with( 'error', 'Usuario no encontrado.' );
        }
        if ( $usuario->role === 'admin' ) {
            return redirect()->back()->with( 'error', 'No es posible eliminar un usuario administrador.' );
        }
        try {

            // Intentar eliminar el usuario
            $usuario->delete();
            return redirect()->back()->with( 'success', 'Usuario eliminado exitosamente.' );
        } catch ( \Exception $e ) {
            // Manejar posibles errores
            return redirect()->back()->with( 'error', 'Hubo un problema al eliminar el usuario.' );
        }

    }

    public function changeRole( $id ) {

        // Encuentra el usuario por ID
        $user = User::find( $id );

        // Verifica si el usuario existe
        if ( !$user ) {
            return redirect()->back()->with( 'error', 'Usuario no encontrado.' );
        }

        // Cambia el rol de 'user' a 'admin' y viceversa
        if ( $user->role === 'user' ) {
            $user->role = 'admin';
        } else {
            $user->role = 'user';
        }

        // Guarda los cambios
        $user->save();

        // Redirige de vuelta con un mensaje de éxito
        return redirect()->back()->with( 'success', 'Rol cambiado exitosamente.' );
    }
}
