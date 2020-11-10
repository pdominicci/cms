<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth;
use App\User;

class ConnectController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except(['getLogout']);    
    }
    public function getLogin(){
        return view('connect.login');
    }
    public function postLogin(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
        $messages = [
            'email.required' => 'Su correo e-mail es requerido.',
            'email.email' => 'El formato de su e-mail es inválido',
            'password.required' => 'Por favor ingrese una contraseña.',
            'password.min' => 'La clave debe tener al menos 8 caracteres.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger');
        else:
            if(Auth::attempt(['email' => $request -> input('email'), 'password' => $request -> input('password')], true)):
                return redirect('/');
            else:
                return back()->with('message','E-mail o contraseña incorrecta')->with('typealert', 'danger');
            endif;
        endif;
    }
    public function getRegister(){
        return view('connect.register');
    }
    public function postRegister(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:App\User,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password',
        ];

        $messages = [
            'name.required' => 'Su nombre es requerido.',
            'lastname.required' => 'Su apellido es requerido.',
            'email.required' => 'Su correo e-mail es requerido.',
            'email.email' => 'El formato de su e-mail es inválido',
            'email.unique' => 'Ya existe un usuario registrado con el e-mail ingresado',
            'password.required' => 'Por favor ingrese una contraseña.',
            'password.min' => 'La clave debe tener al menos 8 caracteres.',
            'cpassword.required' => 'Es necesario confirmar la clave',
            'cpassword.min' => 'La confirmación de la clave debe tener al menos 8 caracteres.',
            'cpassword.same' => 'La clave y la confirmación de la clave deben coincidir.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger');
        else:
            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->email = e($request->input('email'));
            $user->password = Hash::make($request->input('password'));

            if($user->save()): 
                return redirect('/login')->with('message','Su usuario ha sido registrado exitosamente, ya puede iniciar sesión')->with('typealert', 'success');
            endif;
        endif;

    }
    public function getRecover(){
        return view('connect.recover');
    }
    public function postRecover(){
    }
    public function getLogout(){
        Auth::logout();
        return redirect('/');
    }
}
