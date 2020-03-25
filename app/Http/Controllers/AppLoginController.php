<?php

namespace App\Http\Controllers;

use App\Student;
use App\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AppLoginController extends Controller
{
    public function logingApp(Request $req){
        $student = Student::where('email', $req->email)->first();
        if(!empty($student)){
            $pass = ($req->password);
            if(Hash::check($pass, $student->password)){
                $response = array('error_code' => 200, 'error_msg' => 'Alumno', 'id' => $student->id, 'name' => $student->name, 'email' => $student->email, 'license' => $student->license);
            }else{
                $response = array('error_code' => 404, 'error_msg' => 'Contraseña erronea');
            }
        }else{
            $teacher = Teacher::where('email', $req->email)->first();
            
            if(!empty($teacher)){
                $studens = Student::where('teacher_id', $teacher->id)->get();
                $pass = $req->password;
                if(Hash::check($pass, $teacher->password)){
                    $response = array('error_code' => 200, 'error_msg' => 'Profesor', 'id' => $teacher->id, 'name' => $teacher->name, 'email' => $teacher->email, 'number_of_students' => count($studens));
                }else{
                    $response = array('error_code' => 404, 'error_msg' => 'Contraseña erronea');
                }
            }else{
                $response = array('error_code' => 404, 'error_msg' => 'email erroneo');
            }
        }
        return response() -> json($response);
    }
}