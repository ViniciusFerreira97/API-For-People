<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ControllerUsuario extends Controller
{
    public function registrarUsuario(Request $request){
        $rules = array(
            'login'    => 'required|min:5|max:10',
            'senha' => 'required|alphaNum|min:6',
            'nome' => 'required',
            'email' => 'required|email',
            'endereco' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $return['success'] = false;
            $return['data'] = $validator->errors()->all();
            return $return;
        }

        $existenciaLogin = \App\Usuario::where('login','=',$request->login)->get();
        $existenciaEmail = \App\Usuario::where('email','=',$request->email)->get();

        if($existenciaEmail->count() < 1 && $existenciaLogin->count() < 1){
            $usuario = new usuario;
            $usuario->nome = $request->nome;
            $usuario->login = $request->login;
            $usuario->email = $request->email;
            $usuario->senha = $request->senha;
            $usuario->endereco = $request->endereco;
            $usuario->save();

            $return['success'] = true;
            $return['data'] = $usuario;
            return $return;
        }else{
            $return['success'] = false;
            if($existenciaLogin->count() > 0)
                $return['data'][] = 'Login já em uso.';
            if($existenciaEmail->count() > 0)
                $return['data'][] = 'Email já em uso.';

            return $return;
        }
    }

    public function alterarUsario(Request $request)
    {
        $rules = [
            'senha' => 'required|alphaNum|min:6',
            'nome' => 'required',
            'email' => 'required|email',
            'endereco' => 'required'
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $return['success'] = false;
            $return['data'] = $validator->errors()->all();
            return $return;
        }
        $usuario = \App\Usuario::where('login','=',$request->login)->get();
        if(!isset($usuario) || $usuario == ''){
            $return['success'] = false;
            return $return;
        }
        
        $return['success'] = true;
        $usuario->nome = $request->nome;
        $usuario->login = $request->login;
        $usuario->email = $request->email;
        $usuario->senha = $request->senha;
        $usuario->endereco = $request->endereco;
        $usuario->save();
        
        return $return;
    }

    public function excluirUsuario(Request $request)
    {
        $return['success'] = true;
        $usuario = \App\Usuario::where('login','=',$request->login)->get();
        if(!isset($usuario) || $usuario == ''){
            $return['success'] = false;
            return $return;
        }
        Usuario::destroy($usuario);
        return $return;
    }

    public function getUsuariosGeral()
    {
        $usuario = Usuario::all();
        if(!isset($usuario) || $usuario == ''){
            $return['success'] = false;
            return $return;
        }
        $return['success'] = true;
        $return['data'] = [];
        $count = 0;
        foreach($usuario as $u)
        {
            $return['data'][$count]['login'] = $u->login;
            $return['data'][$count]['nome'] = $u->nome;
            $return['data'][$count]['email'] = $u->email;
            $return['data'][$count]['endereco'] = $u->endereco;
            $count ++;
        }
        return $return;
    }

    public function getUsuarioID(Request $request)
    {
        $login = $request->query("login");
        $usuario = \App\Usuario::where('login','=',$request->login)->get();
        if(!isset($usuario) || $usuario == ''){
            $return['success'] = false;
            return $return;
        }
        $return['success'] = true;
        $return['login'] = $usuario->login;
        $return['nome'] = $usuario->nome;
        $return['email'] = $usuario->email;
        $return['endereco'] = $usuario->endereco;
        return $return;
    }
}
