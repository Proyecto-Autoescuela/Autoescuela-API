@extends('layouts.app')


@section('header')
<ul class="nav justify-content-center">
    <div class="nav " id="nav-tab" role="tablist">
        <a class="nav-link" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="false" href="#" onclick="location.href = '{{ route('users') }}'">USUARIOS</a>
        <a class="nav-link" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="false" href="#" onclick="location.href = '{{ route('units') }}'">TEMAS</a>
        <a class="nav-link active" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="true" href="#"  onclick="location.href = '{{ route('tests') }}'">TESTS</a>
    </div>
</ul>
@endsection

@section('styles')
    <link href="{{ asset('css/tests.css') }}" rel="stylesheet">
@endsection


@php( $units = \App\Unit::all())
@php( $ques = \App\Question::all())

@section('content')
<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">TESTS</div>
                <div class="card-body">
                    <form action="{{ action('UnitController@listByName') }}" method="GET" role="search">
                        <div class="input-group mb-3">
                            <input required type="text" class="form-control" placeholder="Introduce el nombre del tema" name="name" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-secondary" type="button" value="Buscar"/>
                                <input type="button" class="btn btn-outline-secondary open-addModal" data-toggle="modal" data-target="#addModal" value="Añadir"/>
                            </div>
                        </div>
                    </form>
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
                    @if(isset($que))
                        @foreach($que as $response)
                        @endforeach
                    @else
                        @foreach($units as $u)
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header myGrid" id="headingOne">
                                        <img width="80%" src="{{ URL::to('../') }}/storage/app/public/{{$u->img}}"/>
                                        <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <h5 class="mb-0" style="float: left">Tema {{$u->id}}: {{$u->name}}</h5>
                                        </button>
                                    </div>
                                </div>
                                @foreach($u->questions as $q)
                                    <div class="testsGrid">
                                        <div class="testImage">
                                            <img width="100%" src="{{ URL::to('../') }}/storage/app/public/{{$q->photo_url}}"/>
                                        </div>
                                        <div class="testContent">
                                            <div>
                                                <b>{{$q->question}}</b>
                                            </div>
                                            <div>
                                                <p>a){{$q->answer_a}}</p>
                                            </div>
                                            <div>
                                                <p>b){{$q->answer_b}}</p>
                                            </div>
                                            <div>
                                                <p>c){{$q->answer_c}}</p>
                                            </div>
                                            <div>
                                                <p>Opción correcta: {{$q->correct_answer}}</p>
                                            </div>
                                        </div>
                                        <button class="open-deleteDialog close exit" data-name="{{"$q->question"}}" data-id="{{$q->id}}" type="button" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            </div>  
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{--Modal for add a test--}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Añadir test</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ action('TestController@addTest') }}" role="form" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <p>Imagen:</p><img id="previewHolder" width="100" height="100px" style="max-width: 200px; display:block; margin:auto"/>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="file" accept="image/*" name="photo_url" id="filePhoto" class="required borrowerImageFile" data-errormsg="PhotoUploadErrorMsg">
                </div>
                <div class="form-group mb-2">
                    <p>Pregunta: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Pregunta" name="question" required>
                </div>
                <div class="form-group mb-2">
                    <p>Respuesta A: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Respuesta A" name="answer_a" required>
                </div>
                <div class="form-group mb-2">
                    <p>Respuesta B: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Respuesta B" name="answer_b" required>
                </div>
                <div class="form-group mb-2">
                    <p>Respuesta C: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Respuesta C" name="answer_c" required>
                </div>
                <div class="form-group mb-2">
                    <p>Respuesta Correcta: </p>
                </div>
                <select class="form-control mx-sm-3 mb-2" style="max-width: 27rem" name="correct_answer" required>
                    <option value=""></option>
                    <option value="answer_a">A</option>
                    <option value="answer_b">B</option>
                    <option value="answer_c">C</option>
                </select>
                <div class="form-group mb-2">
                    <p>Asociado al tema: </p>
                </div>
                <select class="form-control mx-sm-3 mb-2" style="max-width: 27rem" name="unit_id" aria-describedby="basic-addon2" required>
                    <option value=""></option>
                    @foreach($units as $u)
                        <option value="{{$u->id}}">Tema {{$u->id}}: {{$u->name}}</option>
                    @endforeach
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

{{--Modal for delete a test--}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar test</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ action('TestController@deleteTest') }}" role="form">
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
</div>



@endsection