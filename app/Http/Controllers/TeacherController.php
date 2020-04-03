<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller 
{

    // Listar profesores
    public function listAllTeacher(){
        $teachers = Teacher::all(['id', 'name', 'email']);
        if(empty($teachers)){
            $teachers = array('error_code' => 400, 'error_msg' => 'No hay profesores encontrados');
        }else{
            return response()->json($teachers);
        }
    }

    // Buscar por nombre
    public function listByName()
    {   
        $name = ucfirst(Input::get ('name'));
        $response = array('error_code' => 404, 'error_msg' => 'Nombre ' .$name. ' no encontrado');
        $response = Teacher::where('name','LIKE','%'.$name.'%')
        ->get(['id', 'name', 'email']);
        if(count($response) > 0)
            return view('teachersPanel', ['teacher' => $response]);
        else return redirect('/users/teachers')->with('error', 'No se han encontrado profesores con este nombre');
    }
    
    // Añadir profesor
    public function addTeacher(Request $req)
    {
        $response = array('error_code' => 400, 'error_msg' => 'Error inserting info');
        $teachers = new Teacher;

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
                $teachers->name = $req->input('name');
                $teachers->email = $req->input('email');
                $pass = Hash::make($req->password);
                $teachers->password = $pass;
                $teachers->save();
                $response = array('error_code' => 200, 'error_msg' => '');
                }
                catch(\Exception $e)
                {
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }
        if($response['error_code'] == 200){
            return redirect('/users/teachers')->with('success', 'Usuario añadido');
        }else if($response['error_code'] == 500){
            return redirect('/users/teachers')->with('error', 'Este correo ya esta en uso');
        }else{
            return redirect('/users/teachers')->with('error', 'No se pudo procesar la petición');
        }
    }

    // Editar profesor
    public function updateTeacher(Request $req)
    {
        $teacher_id = $req->id;
        $response = array('error_code' => 404, 'error_msg' => 'Profesor '.$teacher_id.' no encontrado');
        $teachers = Teacher::find($teacher_id);
        if(!empty($teachers)){
            $dataOk = true;
            $error_msg = "";
            if(empty($req->name)){
                $dataOk = false;
                $error_msg = "Name no puede estar vacio";
            }else{
                $teachers->name = $req->name;
            }
            if(empty($req->email)){
                $dataOk = false;
                $error_msg = "Email no puede estar vacio";
            }else{
                $teachers->email = $req->email;
            }
            if(!$dataOk){
                $response = array('error_code' => 400, 'error_msg' => $error_msg);
            }else{
                try{
                    $teachers->name = $req->input('name');
                    $teachers->email = $req->input('email') ;
                    $teachers->save();
                    $response = array('error_code' => 200, 'error_msg' => '');
                }catch(\Exception $e){
                    $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
                }
            }
            if($response['error_code'] == 200){
                return redirect('/users/teachers')->with('success', 'Usuario editado');
            }else if($response['error_code'] == 500){
                return redirect('/users/teachers')->with('error', 'Error al editar');
            }else{
                return redirect('/users/teachers')->with('error', 'No se pudo procesar la petición');
            }
        }
    }

    // Borrar profesor
    public function deleteTeacher(Request $req)
    {
        $id = $req->userID;
        $response = array('error_code' => 404, 'error_msg' => 'Profesor '.$id.' no encontrado');
        $teachers = Teacher::find($id);
        if(empty($teachers)){
            $response = array('error_code' => 400, 'error_msg' => "Profesor ".$id." no puede ser borrado");
        }else{
            try{
                $teachers->delete();
                $response = array('error_code' => 200, 'error_msg' => '');
            }catch(\Exception $e){
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }
        if($response['error_code'] == 200){
            return redirect('/users/teachers')->with('success', 'Usuario eliminado');
        }else if($response['error_code'] == 500){
            return redirect('/users/teachers')->with('error', 'Este profesor tiene alumnos asignados y no se puede eliminar');
        }else{
            return redirect('/users/teachers')->with('error', 'No se pudo procesar la petición');
        }
    }

    //Recover password
    public function recoverPass(Request $req){
        $teachers_id = $req->id;
        $response = array('error_code' => 404, 'error_msg' => 'Estudiante '.$teachers_id.' no encontrado');
        $teachers = Teacher::find($teachers_id);
        if(empty($req->password)){
            $dataOk = false;
            $error_msg = "Paswword can't be empty";
        }else{
            $teachers->password = $req->password;
        }
        if(!$dataOk){
            $response = array('error_code' => 400, 'error_msg' => $error_msg);
        }else{
            try{
                $teachers->name = $teachers->name;
                $teachers->email = $teachers->email;
                $pass = Hash::make($req->password);
                $teachers->password = $pass;
                $teachers->save();
                $response = array('error_code' => 200, 'error_msg' => 'contraseña cambiada');
            }catch(\Exception $e){
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }
        return response()->json($teachers);
    }
}