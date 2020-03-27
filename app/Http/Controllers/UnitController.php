<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Facades\Input;

class UnitController extends Controller
{
    public function listAllUnits(){
        $unit = Unit::all(['id', 'name', 'img']);
        if(empty($unit)){
            $unit = array('error_code' => 400, 'error_msg' => 'No hay unit encontrados');
        }else{
            return response()->json($unit);
        }
    }

    public function listByName()
    {   
        $name = ucfirst(Input::get ('name'));
        $response = array('error_code' => 404, 'error_msg' => 'Tema ' .$name. ' no encontrado');
        $response = Unit::where('name','LIKE','%'.$name.'%')
        ->get(['id', 'name', 'img']);
        if(count($response) > 0)
            return view('unitsPanel', ['unit' => $response]);
        else return redirect('/units')->with('error', 'No se han encontrado temarios con este nombre');
    }

    public function listByID(Request $req)
    {
        $id = $req->id;
        $response = array('error_code' => 404, 'error_msg' => 'Nombre ' .$id. ' no encontrado');
        $response = Unit::where('id', $id)->get();
        if(count($response) > 0)
            return view('unitsPanel', ['unit' => $response]);
        else return redirect('/units')->with('error', 'No se han encontrado temas con este nombre');
    }

    public function findByID(Request $req)
    {
        $id = $req->id;
        $response = array('error_code' => 404, 'error_msg' => 'Nombre ' .$id. ' no encontrado');
        $response = Unit::where('id', $id)->first();
        return response()->json($response);
    }

    // Añadir Temario
    public function addUnit(Request $req)
    {
        $response = array('error_code' => 400, 'error_msg' => 'Error inserting info');
        $units = new Unit;
        
        if(!$req->name){
            $response['error_msg'] = 'Name is required';
        }
        elseif(!$req->img)
        {
            $response['error_msg'] = 'img is required';
        }
        else
        {
            try{
                $units->name = $req->input('name');
                $ruta = $req->file('img')->store('ImagesUnits');
                $units->img = $ruta;
                $units->save();
                $response = array('error_code' => 200, 'error_msg' => '');
                
            }
            catch(\Exception $e){
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }
        if($response['error_code'] == 200){
            return redirect('/units')->with('success', 'Tema añadido');
        }else if($response['error_code'] == 500){
            return redirect('/units')->with('error', 'Este tema ya esta añadido');
        }else{
            return redirect('/units')->with('error', 'No se pudo procesar la petición');
        }
    }

    // Editar temario
    public function updateUnit(Request $req)
    {
        $unit_id = $req->id;
        $response = array('error_code' => 404, 'error_msg' => 'Estudiante '.$unit_id.' no encontrado');
        $units = Unit::find($unit_id);
        if(!empty($units)){
            $dataOk = true;
            $error_msg = "";
            if(empty($req->name)){
                $dataOk = false;
                $error_msg = "Name can't be empty";
            }else{
                $units->name = $req->name;
            }
            if(empty($req->img)){
                $dataOk = false;
                $response['error_msg'] = 'img is required';
            }else{
                $units->img = $req->img;
            }
            if(!$dataOk){
                $response = array('error_code' => 400, 'error_msg' => $error_msg);
            }else{
                try{
                    $units->name = $req->input('name');
                    $ruta = $req->file('img')->store('ImagesUnits');
                    $units->img = $ruta;
                    $units->save();
                    $response = array('error_code' => 200, 'error_msg' => '');
                }catch(\Exception $e){
                    $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
                }
            }
            if($response['error_code'] == 200){
                return redirect('/units')->with('success', 'Tema editado');
            }else if($response['error_code'] == 500){
                return redirect('/units')->with('error', 'Error al editar');
            }else{
                return redirect('/units')->with('error', 'No se pudo procesar la petición');
            }
        }
    }

    // Borrar Temas
    public function deleteUnit(Request $req)
    {
        $id = $req->userID;
        $response = array('error_code' => 404, 'error_msg' => 'Estudiante '.$id.' no encontrado');
        $units = Unit::find($id);
        if(empty($units)){
            $response = array('error_code' => 400, 'error_msg' => "Estudiante ".$id." no puede ser borrado");
        }else{
            try{
                $units->delete();
                $response = array('error_code' => 200, 'error_msg' => '');
            }catch(\Exception $e){
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }
        if($response['error_code'] == 200){
            return redirect('/units')->with('success', 'Tema eliminado');
        }else if($response['error_code'] == 500){
            return redirect('/units')->with('error', 'Error al eliminar');
        }else{
            return redirect('/units')->with('error', 'No se pudo procesar la petición');
        }
    }
}