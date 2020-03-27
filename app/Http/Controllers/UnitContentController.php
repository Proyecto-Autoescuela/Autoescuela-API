<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitContent;

class UnitContentController extends Controller
{
    // Listar temas
    public function listAllUnitContent(){
        $unitContents = UnitContent::all(['id', 'name', 'img', 'content_unit', 'unit_id']);
        if(empty($unitContents)){
            $unitContents = array('error_code' => 400, 'error_msg' => 'No hay temas encontrados');
        }else{
            return response()->json($unitContents);
        }
    }
    

    // Buscar por ID
    public function listByID(Request $req)
    {
        $id = $req->id;
        $response = array('error_code' => 404, 'error_msg' => 'Nombre ' .$id. ' no encontrado');
        $response = UnitContent::where('id', $id)->get();
        return response()->json($response);
    }

    public function findByID(Request $req, $id)
    {
        $id = $req->id;
        $response = array('error_code' => 404, 'error_msg' => 'Nombre ' .$id. ' no encontrado');
        $response = UnitContent::where('id', $id)->first(['name', 'content_unit']);
        if(count($response) > 0)
            return view('unitsPanel', ['unit_content' => $response]);
        else return view('unitsPanel')->withMessage('No Details found. Try to search again !');
    }
    
    public function findByLessonID(Request $req)
    {
        $id = $req->id;
        $response = array('error_code' => 404, 'error_msg' => 'Nombre ' .$id. ' no encontrado');
        $response = UnitContent::where('unit_id', $id)->get(['name', 'img']);
        // if(count($response) > 0)
        //     return view('unitViews/searchUnitsView', ['unit' => $response]);
        // else return view('unitViews/searchUnitsView')->withMessage('No Details found. Try to search again !');
        return response()->json($response);
    }

    // Añadir Temario
    public function addUnitContent(Request $req)
    {
        $response = array('error_code' => 400, 'error_msg' => 'Error inserting info');
        $unitContents = new UnitContent;
        
        if(!$req->name){
            $response['error_msg'] = 'Name is required';
        }
        elseif(!$req->img)
        {
            $response['error_msg'] = 'img is required';
        }
        elseif(!$req->content_unit)
        {
            $response['error_msg'] = 'content_unit is required';
        }
        elseif(!$req->id)
        {
            $response['error_msg'] = 'unit_id is required';
        }
        else
        {
            try{
                $unitContents->name = $req->input('name');
                $ruta = $req->file('img')->store('ImagesUnitsContent');
                $unitContents->img = $ruta;
                $unitContents->content_unit = $req->input('content_unit');
                $unitContents->unit_id = $req->input('id');
                $unitContents->save();
                $response = array('error_code' => 200, 'error_msg' => '');
            }
            catch(\Exception $e){
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }
        if($response['error_code'] == 200){
            return redirect('/units')->with('success', 'Punto añadido');
        }else if($response['error_code'] == 500){
            return redirect('/units')->with('error', 'Este punto ya esta añadido');
        }else{
            return redirect('/units')->with('error', 'No se pudo procesar la petición');
        }
    }

    // Editar temario
    public function updateUnitContent(Request $req)
    {
        $unit_id = $req->id;
        $response = array('error_code' => 404, 'error_msg' => 'Estudiante '.$unit_id.' no encontrado');
        $unitContents = UnitContent::find($unit_id);
        if(!empty($unitContents)){
            $dataOk = true;
            $error_msg = "";
            if(empty($req->name)){
                $dataOk = false;
                $error_msg = "Name can't be empty";
            }else{
                $unitContents->name = $req->name;
            }
            if(empty($req->img)){
                $dataOk = false;
                $error_msg = "img can't be empty";
            }else{
                $unitContents->img = $req->img;
            }
            if(empty($req->content_unit)){
                $dataOk = false;
                $error_msg = "content_unit can't be empty";
            }else{
                $unitContents->content_unit = $req->content_unit;
            }
            if(empty($req->unit_id)){
                $dataOk = false;
                $error_msg = "content_unit can't be empty";
            }else{
                $unitContents->unit_id = $req->unit_id;
            }
            if(!$dataOk){
                $response = array('error_code' => 400, 'error_msg' => $error_msg);
            }else{
                try{
                    $unitContents->name = $req->input('name');
                    $ruta = $req->file('img')->store('ImagesUnits');
                    $unitContents->img = $ruta;
                    $unitContents->content_unit = $req->input('content_unit');
                    $unitContents->unit_id = $req->input('unit_id');
                    $unitContents->save();
                    $response = array('error_code' => 200, 'error_msg' => '');
                }catch(\Exception $e){
                    $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
                }
            }
            if($response['error_code'] == 200){
                return redirect('/units')->with('success', 'Punto editado');
            }else if($response['error_code'] == 500){
                return redirect('/units')->with('error', 'Error al editar');
            }else{
                return redirect('/units')->with('error', 'No se pudo procesar la petición');
            }
        }
    }

    // Borrar Temas
    public function deleteUnitContent(Request $req)
    {
        $id = $req->contentID;
        $response = array('error_code' => 404, 'error_msg' => 'Estudiante '.$id.' no encontrado');
        $unitContents = UnitContent::find($id);
        if(empty($unitContents)){
            $response = array('error_code' => 400, 'error_msg' => "Estudiante ".$id." no puede ser borrado");
        }else{
            try{
                $unitContents->delete();
                $response = array('error_code' => 200, 'error_msg' => '');
            }catch(\Exception $e){
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }
        if($response['error_code'] == 200){
            return redirect('/units')->with('success', 'Punto eliminado');
        }else if($response['error_code'] == 500){
            return redirect('/units')->with('error', 'Error al eliminar');
        }else{
            return redirect('/units')->with('error', 'No se pudo procesar la petición');
        }
    }

}
