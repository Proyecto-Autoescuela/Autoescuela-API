<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function listAllUser(){
        $users = User::all(['id', 'name', 'email']);
        if(empty($users)){
            $users = array('error_code' => 400, 'error_msg' => 'No hay users encontrados');
        }else{
            return response()->json($users);
        }
    }

    // Buscar por nombre
    public function listByName()
    {   
        $name = ucfirst(Input::get ('name'));
        $response = array('error_code' => 404, 'error_msg' => 'Nombre ' .$name. ' no encontrado');
        $response = User::where('name','LIKE','%'.$name.'%')
        ->get(['id', 'name', 'email']);
        if(count($response) > 0)
            return view('adminsPanel', ['admin' => $response]);
        else return redirect('/users/admins')->with('error', 'No se han encontrado administradores con este nombre');
    }
    
    public function addAdmin(Request $req)
    {
        $response = array('error_code' => 400, 'error_msg' => 'Error inserting info');
        $users = new User;

        if(!$req->name){
            $response['error_msg'] = 'Name es necesario';
        }
        elseif(!$req->email)
        {
            $response['error_msg'] = 'Email es necesario';
        }
        elseif(!$req->password)
        {
            $response['error_msg'] = 'Password es necesario';
        }
        else
        {
            try{
                $users->name = $req->input('name');
                $users->email = $req->input('email') ;
                $users->password = Hash::make($req->password);
                $users->api_token = Str::random(60);
                $users->save();
                $response = array('error_code' => 200, 'error_msg' => '');
                }
                catch(\Exception $e)
                {
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }
        if($response['error_code'] == 200){
            return redirect('/users/admins')->with('success', 'Usuario añadido');
        }else if($response['error_code'] == 500){
            return redirect('/users/admins')->with('error', 'Este correo ya esta en uso');
        }else{
            return redirect('/users/admins')->with('error', 'No se pudo procesar la petición');
        }
    }

    public function updateAdmin(Request $req)
    {
        $admin_id = $req->id;
        $response = array('error_code' => 404, 'error_msg' => 'user '.$admin_id.' no encontrado');
        $users = User::find($admin_id);
        if(!empty($users)){
            $dataOk = true;
            $error_msg = "";
            if(empty($req->name)){
                $dataOk = false;
                $error_msg = "Name no puede estar vacio";
            }else{
                $users->name = $req->name;
            }
            if(empty($req->email)){
                $dataOk = false;
                $error_msg = "Email no puede estar vacio";
            }else{
                $users->email = $req->email;
            }
            if(!$dataOk){
                $response = array('error_code' => 400, 'error_msg' => $error_msg);
            }else{
                try{
                    $users->name = $req->input('name');
                    $users->email = $req->input('email') ;
                    $users->save();
                    $response = array('error_code' => 200, 'error_msg' => '');
                }catch(\Exception $e){
                    $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
                }
            }
            if($response['error_code'] == 200){
                return redirect('/users/admins')->with('success', 'Usuario modificado');
            }else if($response['error_code'] == 500){
                return redirect('/users/admins')->with('error', 'Error al editar');
            }else{
                return redirect('/users/admins')->with('error', 'No se pudo procesar la petición');
            }
        }
    }

    public function deleteAdmin(Request $req)
    {
        $admin_id = $req->userID;
        $response = array('error_code' => 404, 'error_msg' => 'user '.$admin_id.' no encontrado');
        $users = User::find($admin_id);
        if(empty($users)){
            $response = array('error_code' => 400, 'error_msg' => "user ".$admin_id." no puede ser borrado");
        }else{
            try{
                $users->delete();
                $response = array('error_code' => 200, 'error_msg' => '');
            }catch(\Exception $e){
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }
        if($response['error_code'] == 200){
            return redirect('/users/admins')->with('success', 'Usuario eliminado');
        }else if($response['error_code'] == 500){
            return redirect('/users/admins')->with('error', 'Error al eliminar');
        }else{
            return redirect('/users/admins')->with('error', 'No se pudo procesar la petición');
        }
    }
}