@extends('layouts.app')

@section('content')
@php( $students = \App\Student::all())
@php( $teachers = \App\Teacher::all())
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">AÑADIR</div>
                <div class="card-body">
                     <form method="POST" action="{{ action('StudentController@addStudent') }}" role="form">
                        <div class="form-group mb-2">
                          <p>Nombre: </p>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" placeholder="Nombre" name="name" required>
                        </div>
                        <div class="form-group mb-2">
                          <p>Correo: </p>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="email" class="form-control" placeholder="Correo" name="email" required>
                        </div>
                        <div class="form-group mb-2">
                            <p>Contraseña: </p>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" placeholder="Contraseña" name="password" required>
                        </div>
                        <div class="form-group mb-2">
                            <p>Profesor: </p>
                        </div>
                        <select class="form-control mx-sm-3 mb-2" style="max-width: 41rem" name="teacher_id" required>
                            <option value=""></option>
                            @foreach($teachers as $t)
                                <option value="{{$t->id}}">{{$t->id}} - {{$t->name}}</option>
                            @endforeach
                        </select>
                        <div class="form-group mb-2">
                            <p>Licencia: </p>
                        </div>
                        <select class="form-control mx-sm-3 mb-2" style="max-width: 41rem" name="license" required>
                            <option>A</option>
                            <option>A1</option>
                            <option>A2</option>
                            <option>B</option>
                            <option>B+E</option>
                            <option>C</option>
                            <option>C+E</option>
                            <option>D</option>
                            <option>D+E</option>
                        </select>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <input style="margin-top: 1rem" type="submit" class="btn btn-light btn-lg btn-block" value="AÑADIR" />
                    </form>
                    <input style="margin-top: 1rem" type="button" class="btn btn-light btn-lg btn-block" value="ATRAS" onclick="location.href = '{{ route('students') }}'"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection