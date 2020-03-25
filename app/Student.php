<?php

namespace App;

use App\Teacher;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function getTeacherName($id)
    {
        $teacher_id = Student::where('id', $id)->get()[0]; 
        $teacher_id = $teacher_id->teacher_id;
        $teacher_name = Teacher::find($teacher_id);
        return $teacher_name->name;
    }
}
