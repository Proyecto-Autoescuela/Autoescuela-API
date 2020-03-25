@extends('layouts.app')

@section('header')
<ul class="nav justify-content-center">
    <div class="nav " id="nav-tab" role="tablist">
        <a class="nav-link active" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="true" href="#" onclick="location.href = '{{ route('users') }}'">USUARIOS</a>
        <a class="nav-link" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="false" href="#" onclick="location.href = '{{ route('units') }}'">TEMAS</a>
        <a class="nav-link" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="false" href="#" onclick="location.href = '{{ route('tests') }}'">TESTS</a>
    </div>
</ul>
@endsection

@section('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@php( $teachers = \App\Teacher::all())
@php( $students = \App\Student::all())

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">USUARIOS</div>
                <div class="card-body">
                    <nav class="nav-justified" style="margin-bottom: 1rem">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-parent-tab" data-toggle="tab" role="tab" aria-controls="nav-parent" aria-selected="true">ALUMNOS</a>
                            <a class="nav-item nav-link" id="nav-parent-tab" data-toggle="tab" href="#" onclick="location.href = '{{ route('teachers') }}'" role="tab" aria-controls="nav-parent" aria-selected="false">PROFESORES</a>
                            <a class="nav-item nav-link" id="nav-parent-tab" data-toggle="tab" href="#" onclick="location.href = '{{ route('admins') }}'" role="tab" aria-controls="nav-parent" aria-selected="false">ADMINS</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-default" role="tabpanel" aria-labelledby="nav-default-tab">
                            <form action="{{ action('StudentController@listByName') }}" method="GET" role="search">
                                <div class="input-group mb-3">
                                    <input required type="text" class="form-control" placeholder="Introduce el nombre del usuario" name="name" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <input type="submit" class="btn btn-outline-secondary" type="button" value="Buscar"/>
                                        <input type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#addModal" value="Añadir"/>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Profesor</th>
                                    <th scope="col">Licencia</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(isset($student))
                                        @foreach($student as $response)
                                            <tr>
                                                <th scope="row">{{$response->id}}</th>
                                                <td><p data-editable>{{$response->name}}</p></td>
                                                <td><p data-editable>{{$response->email}}</p></td>
                                                <td><p>{{$response->getTeacherName($response->id)}}</p></td>
                                                <td><p data-editableSelect>{{$response->license}}</p></td>
                                                <td>
                                                    <button class="open-deleteDialog close" data-name="{{$response->name}}" data-id="{{$response->id}}" type="button" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach($students as $s)
                                            <tr id="table">
                                                <th scope="row">{{$s->id}}</th>
                                                <td><p id="name" editable data-id="{{$s->id}}">{{$s->name}}</p></td>
                                                <td><p id="email" editable data-id="{{$s->id}}">{{$s->email}}</p></td>
                                                <td>
                                                    <select id="teacher_id" class="custom-select">
                                                        <option disabled selected>{{$s->getTeacherName($s->id)}}</option>
                                                        @foreach($teachers as $t)
                                                            <option value="{{$t->id}}" data-id="{{$s->id}}">{{$t->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="license" class="custom-select">
                                                        <option disabled selected>{{$s->license}}</option>
                                                        <option value="A" data-id="{{$s->id}}">A</option>
                                                        <option value="A1" data-id="{{$s->id}}">A1</option>
                                                        <option value="A2" data-id="{{$s->id}}">A2</option>
                                                        <option value="B" data-id="{{$s->id}}">B</option>
                                                        <option value="B+E" data-id="{{$s->id}}">B+E</option>
                                                        <option value="C" data-id="{{$s->id}}">C</option>
                                                        <option value="C+E" data-id="{{$s->id}}">C+E</option>
                                                        <option value="D" data-id="{{$s->id}}">D</option>
                                                        <option value="D+E" data-id="{{$s->id}}">D+E</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="open-deleteDialog close" data-name="{{$s->name}}" data-id="{{$s->id}}" type="button" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--Modal for add a user--}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Añadir alumno</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
                <select class="form-control mx-sm-3 mb-2" style="max-width: 27rem" name="teacher_id" required>
                    <option value=""></option>
                    @foreach($teachers as $t)
                        <option value="{{$t->id}}">{{$t->id}} - {{$t->name}}</option>
                    @endforeach
                </select>
                <div class="form-group mb-2">
                    <p>Licencia: </p>
                </div>
                <select class="form-control mx-sm-3 mb-2" style="max-width: 27rem" name="license" required>
                    <option value=""></option>
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
                <div class="modal-footer">
                    <input style="margin-top: 1rem" type="submit" class="btn btn-light" value="Cerrar" data-dismiss="modal"/>
                    <input style="margin-top: 1rem" type="submit" class="btn btn-info" value="Añadir"/>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

{{--Modal for delete--}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar alumno</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ action('StudentController@deleteStudent') }}" role="form">
            {{ method_field('DELETE') }}
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="modal-body">
                <input type="hidden" id="userID" name="userID" value="">
                <p id="userName"></p>
            <div class="modal-footer">  
                <input style="margin-top: 1rem" type="button" class="btn btn-light" value="Cancelar" data-dismiss="modal"/>
                <input id='delete' style="margin-top: 1rem" type="submit" class="btn btn-danger deleteUser" value="Eliminar">
            </div>
        </form>
      </div>
    </div>
</div>

@endsection