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
<div class="container-xl">
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
                                    @if (session('error'))
                                        <div class="col-sm-12">
                                            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('error') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="col-sm-12">
                                            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($student))
                                        <input type="button" class="btn btn-outline-secondary btn-block buttonBack" value="Volver" onclick="location.href = '{{ route('users') }}'"/>
                                        @foreach($student as $response) 
                                            <tr id="table">
                                                <th scope="row">{{$response->id}}</th>
                                                <td><p id="name" class="open-editDialog cursor"data-id="{{$response->id}}" data-name="{{$response->name}}" data-email="{{$response->email}}" data-teacher_id="{{$response->teacher_id}}" data-license="{{$response->license}}">{{$response->name}}</p></td>
                                                <td><p id="email" class="open-editDialog cursor" data-id="{{$response->id}}" data-name="{{$response->name}}" data-email="{{$response->email}}" data-teacher_id="{{$response->teacher_id}}" data-license="{{$response->license}}">{{$response->email}}</p></td>
                                                <td><p id="teacher_id" class="open-editDialog cursor" data-id="{{$response->id}}" data-name="{{$response->name}}" data-email="{{$response->email}}" data-teacher_id="{{$response->teacher_id}}" data-license="{{$response->license}}">{{$response->getTeacherName($response->id)}}</p></td>
                                                <td><p id="license" class="open-editDialog cursor" data-id="{{$response->id}}" data-name="{{$response->name}}" data-email="{{$response->email}}" data-teacher_id="{{$response->teacher_id}}" data-license="{{$response->license}}">{{$response->license}}</p></td>
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
                                                <td><p id="name" class="open-editDialog cursor"data-id="{{$s->id}}" data-name="{{$s->name}}" data-email="{{$s->email}}" data-teacher_id="{{$s->teacher_id}}" data-license="{{$s->license}}">{{$s->name}}</p></td>
                                                <td><p id="email" class="open-editDialog cursor" data-id="{{$s->id}}" data-name="{{$s->name}}" data-email="{{$s->email}}" data-teacher_id="{{$s->teacher_id}}" data-license="{{$s->license}}">{{$s->email}}</p></td>
                                                <td><p id="teacher_id" class="open-editDialog cursor" data-id="{{$s->id}}" data-name="{{$s->name}}" data-email="{{$s->email}}" data-teacher_id="{{$s->teacher_id}}" data-license="{{$s->license}}">{{$s->getTeacherName($s->id)}}</p></td>
                                                <td><p id="license" class="open-editDialog cursor" data-id="{{$s->id}}" data-name="{{$s->name}}" data-email="{{$s->email}}" data-teacher_id="{{$s->teacher_id}}" data-license="{{$s->license}}">{{$s->license}}</p></td>
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
                <input type="text" class="form-control" placeholder="Nombre" name="name" maxlength="40" required>
                </div>
                <div class="form-group mb-2">
                  <p>Correo: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="email" class="form-control" placeholder="Correo" name="email"  maxlength="50" required>
                </div>
                <div class="form-group mb-2">
                    <p>Contraseña: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Contraseña" name="password" minlength="5" required>
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

{{--Modal for edit--}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar alumno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ action('StudentController@updateStudent') }}" role="form">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="id" name="id" value="">
                <div class="form-group mb-2">
                    <p>Nombre: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Nombre" id="name" name="name" maxlength="40" required>
                </div>
                <div class="form-group mb-2">
                    <p>Correo: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="email" class="form-control" placeholder="Correo" id="email" name="email" maxlength="50" required>
                </div>
                <div class="form-group mb-2">
                    <p>Profesor: </p>
                </div>
                <select class="form-control mx-sm-3 mb-2" style="max-width: 27rem" id="teacher" name="teacher_id" required>
                    @foreach($teachers as $t)
                        <option value="{{$t->id}}">{{$t->id}} - {{$t->name}}</option>
                    @endforeach
                </select>
                <div class="form-group mb-2">
                    <p>Licencia: </p>
                </div>
                <select class="form-control mx-sm-3 mb-2" style="max-width: 27rem" id="license" name="license" required>
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
                <div class="modal-footer">
                    <input style="margin-top: 1rem" type="submit" class="btn btn-light" value="Cerrar" data-dismiss="modal"/>
                    <input style="margin-top: 1rem" type="submit" class="btn btn-info" value="Editar"/>
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