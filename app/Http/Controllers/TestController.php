<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Question;
use App\Student;

class TestController extends Controller{

    // Listar todos
    public function listAllTest(){
        $tests = Test::all(['id', 'calification', 'student_id','unit_id']);
        if(empty($tests)){
            $tests = array('error_code' => 400, 'error_msg' => 'No hay tests encontrados');
        }else{
            return response()->json($tests);
        }
    }

    // Listar por alumno
    public function listForStuden(Request $req){
        $student_id = $req->student_id;
        $response = array('error_code' => 404, 'error_msg' => 'Nombre ' .$student_id. ' no encontrado');
        $response = Test::where('student_id', $student_id)->get();
        return response()->json($response);
    }
    public function porcentajeUnit($student_id){
        $unit_id = 1;
        $response = array('error_code' => 404, 'error_msg' => 'Nombre ' .$student_id. ' no encontrado');
        $tests = Test::where('student_id', $student_id)->where('unit_id', $unit_id)->get();
        $aciertos = 0;
        $fallos = 0;
        $porcentaje = 0;
        $preguntas = count($tests) * 10;
        $response = $tests;
        foreach ($tests as $test) {
            $aciertos = $aciertos + $test->calification;
            $fallo = 10 - $test->calification;
            $fallos = $fallos + $fallo;
            $porcentaje = $aciertos/$preguntas;
            $porcentaje = $porcentaje*100;
        }
        $response = array('error_code' => 200, 'porcentaje' =>  round($porcentaje, 2). '%');
        return response()->json($response);
    }

    // Listar por Unidad
    public function listForLesson(Request $req){
        $unit_id = $req->unit_id;
        $response = array('error_code' => 404, 'error_msg' => 'Nombre ' .$unit_id. ' no encontrado');
        $response = Test::where('id', $unit_id)->get();
        return response()->json($response);
    }

    // Listar por aprobado
    public function listForPass(){ 
        $response = array('error_code' => 400, 'error_msg' => 'No hay tests encontrados');
        $response = Test::where('calification', '>=', '9')->get();
        return response()->json($response);
    }

    // Listar por suspenso
    public function listForFail(){ 
        $response = array('error_code' => 400, 'error_msg' => 'No hay tests encontrados');
        $response = Test::where('calification', '<', '9')->get();
        return response()->json($response);
    }

    // Generador de tests
    public function generateTest(){
        $question = Question::inRandomOrder()->get(['photo_url', 'question','answer_a','answer_b','answer_c','correct_answer']);
        
        if(empty($question[0])){
            $response = array('error_code' => 400, 'error_msg' => 'No hay preguntas encontrados');
        }else{
            $questions[0] = $question[0];
            for ($i=1; $i <10 ; $i++){
                if(!empty($question[$i])){
                    array_push($questions,$question[$i]);
                } 
                
            }
            $response = $questions;
            
        }
        return response()->json($response);
    }

    // Generador de tests
    public function generateTestUnit(Request $req){
        $question = Question::inRandomOrder()->where('unit_id', $req->unit_id)->get(['photo_url', 'question','answer_a','answer_b','answer_c','correct_answer']);
        
        if(empty($question[0])){
            $response = array('error_code' => 404, 'error_msg' => 'No hay preguntas encontrados');
        }else{
            $questions[0] = $question[0];
            for ($i=1; $i <10 ; $i++){
                if(!empty($question[$i])){
                    array_push($questions,$question[$i]);
                } 
                
            }
            $response = $questions;
            
        }
        return response()->json($response);
    }

    // Guardar test hecho
    public function saveTest($idStudent, $idUnit, $calification){
        
        $response = array('error_code' => 400, 'error_msg' => 'No se han enviado datos', 'respuesta' => $idStudent, 'respuestas'=>  $idUnit, 'respuestaa'=>  $calification);
        
        $test = new Test;
        
        $test->calification = $calification;
        
        $test->student_id = $idStudent;
        $test->unit_id = $idUnit;
        
        try{
            $test->save();
            $response = array('error_code' => 200, 'error_msg' => '');
        }
        catch(\Exception $e){
            $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
        }
        
        
        
        /*
        if(empty($req)){
            $response = array('error_code' => 400, 'error_msg' => 'No se han enviado datos');
        }else{
            $test = new Test;
            if(empty($req->calification)){
                //$response['error_msg'] = 'calification is required';
                $response = array('error_code' => 404, 'error_msg' => '∫', 'response' => $req);
            }
            elseif(empty($req->student_id)){
                $response['error_msg'] = 'student_id is required';
            }elseif(empty($req->unit_id)){
                $response['error_msg'] = 'unit_id is required';
            }else{
                try{
                    $test->calification = $req->input('calification');
                    $test->student_id = $req->input('student_id');
                    $test->unit_id = $req->input('unit_id');
                    $test->save();
                    $response = array('error_code' => 200, 'error_msg' => '');
                }
                catch(\Exception $e){
                    $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
                }
            }
        }
        */
        return response()->json($response);
    }

    // Eliminar tests por alumno
    public function deleteForStudent($id, $ok){
        $tests = Test::where('student_id', $id)->get();
        foreach ($tests as $test) {
            $test->delete();
            if(empty($ok)){
                return redirect()->action('StudentController@deleteStudent');
            }else{
                $response = array('error_code' => 200, 'error_msg' => '');
            }
        }
        return response()->json($response);
    }
}
