@extends('layouts.app')


@section('header')
<ul class="nav justify-content-center">
    <div class="nav " id="nav-tab" role="tablist">
        <a class="nav-link" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="false" href="#" onclick="location.href = '{{ route('users') }}'">USUARIOS</a>
        <a class="nav-link active" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="true" href="#" onclick="location.href = '{{ route('units') }}'">TEMAS</a>
        <a class="nav-link" id="nav-users-tab" data-toggle="tab" role="tab" aria-controls="nav-users" aria-selected="false" href="#" onclick="location.href = '{{ route('tests') }}'">TESTS</a>
    </div>
</ul>
@endsection

@section('styles')
    <link href="{{ asset('css/units.css') }}" rel="stylesheet">
@endsection

@php 
$i = 1;
$o = 1
@endphp

@php
 $units = \App\Unit::all() 
@endphp


@section('content')
<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">TEMAS</div>
                <div class="card-body">
                    <form action="{{ action('UnitController@listByName') }}" method="GET" role="search">
                        <div class="input-group mb-3">
                            <input required type="text" class="form-control" placeholder="Introduce el nombre del tema" name="name" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-secondary" type="button" value="Buscar"/>
                                <input class="btn btn-outline-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" value="Añadir" />
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#addModal" href="">Tema</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#addModalContent" href="">Contenido</a>
                                </div>
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
                    @if(isset($unit))
                        <input type="button" class="btn btn-outline-secondary btn-block buttonBack" value="Volver" onclick="location.href = '{{ route('units') }}'"/>
                        @foreach($unit as $response)
                             <div id="accordion{{$o}}">
                                <div class="card">
                                    <div class="card-header myGrid" id="headingOne">
                                        <img width="80%" src="{{ URL::to('../') }}/storage/app/public/{{$response->img}}"/>
                                        <button class="btn" data-toggle="collapse" data-target="#collapse{{$o}}" aria-expanded="true" aria-controls="collapse">
                                            <h5 class="mb-0" style="float: left" >Tema {{$response->id}}: {{$response->name}}</h5>
                                        </button>
                                        <input class="open-editDialog btn btn-outline-primary" type="button" data-id="{{$response->id}}" data-name="{{$response->name}}" data-image="{{ URL::to('../') }}/storage/app/public/{{$response->img}}" value="Modificar"/>
                                        <button class="open-deleteDialog close" data-name="{{$response->name}}" data-id="{{$response->id}}" data-image="{{$response->img}}" type="button" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @foreach($response->contents as $uc)
                                        <div id="collapse{{$o}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion{{$o}}">
                                            <div class="card-body">
                                            <div class="itemGrid">
                                                <b>{{$response->id}}.{{$i++}} {{$uc->name}}</b>
                                                <button class="open-deleteContent close" type="button" data-name="{{$uc->name}}" data-id="{{$uc->id}}">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="contenedor">
                                                <p>{{$uc->content_unit}}</p>
                                                <img class="contentImg" width="100%" src="{{ URL::to('../') }}/storage/app/public/{{$uc->img}}"/>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-light" value="Modificar"/>
                                            </div>
                                            </div>
                                        </div>
                                    @endforeach 
                                </div>
                            </div>
                            <input type="hidden"{{$i = 1}} />
                            <input type="hidden"{{$o++}} />
                        @endforeach
                    @else
                        @foreach($units as $u)
                            <div id="accordion{{$o}}">
                                <div class="card">
                                    <div class="card-header myGrid" id="headingOne">
                                        <img width="80%" src="{{ URL::to('../') }}/storage/app/public/{{$u->img}}"/>
                                        <button class="btn" data-toggle="collapse" data-target="#collapse{{$o}}" aria-expanded="true" aria-controls="collapse">
                                            <h5 class="mb-0" style="float: left" >Tema {{$u->id}}: {{$u->name}}</h5>
                                        </button>
                                        <input class="open-editDialog btn btn-outline-primary" type="button" data-id="{{$u->id}}" data-name="{{$u->name}}" data-image="{{ URL::to('../') }}/storage/app/public/{{$u->img}}" value="Modificar"/>
                                        <button class="open-deleteDialog close" data-name="{{$u->name}}" data-id="{{$u->id}}" data-image="{{$u->img}}" type="button" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @foreach($u->contents as $uc)
                                    <div id="collapse{{$o}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion{{$o}}">
                                        <div class="card-body">
                                        <div class="itemGrid">
                                            <b>{{$u->id}}.{{$i++}} {{$uc->name}}</b>
                                            <button class="open-deleteContent close" type="button" data-name="{{$uc->name}}" data-id="{{$uc->id}}">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="contenedor">
                                            {{$uc->content_unit}}
                                            <img class="contentImg" width="100%" src="{{ URL::to('../') }}/storage/app/public/{{$uc->img}}"/>
                                        </div>
                                        <div class="modal-footer">
                                            {{-- <input type="submit" class="btn btn-light" value="Modificar"/> --}}
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach 
                                </div>
                            </div>
                            <input type="hidden"{{$i = 1}} />
                            <input type="hidden"{{$o++}} />
                        @endforeach
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


{{--Modal for add a unit--}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Añadir tema</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ action('UnitController@addUnit') }}" role="form" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <p>Titulo: </p>
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Titulo" name="name" maxlength="50" required>
                  </div>
                  <div class="form-group mb-2">
                    <p>Imagen:</p><img id="uploadPreview" style="max-width: 250px; display:block; margin:auto;"/>
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <input name="img" type="file" id="uploadImage" class="form-control-file" accept="image/*" required onchange="PreviewImage();">
                  </div>
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

{{--Modal for add a unit_content--}}
<div class="modal fade" id="addModalContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Añadir contenido tema</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ action('UnitContentController@addUnitContent') }}" role="form" enctype="multipart/form-data">
                <p>Selecciona el tema a donde se va a añadir</p>
                <select class="form-control mx-sm-3 mb-2" style="max-width: 27rem" name="id" aria-describedby="basic-addon2" required>
                    <option value=""></option>
                    @foreach($units as $u)
                        <option value="{{$u->id}}">Tema {{$u->id}}: {{$u->name}}</option>
                    @endforeach
                </select>
                <br>
                <div class="form-group mb-2">
                    <p>Titulo: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Titulo" name="name" maxlength="50" required>
                </div>
                <div class="form-group mb-2">
                    <p>Imagen:</p><img id="previewHolder" width="100" height="100px" style="max-width: 200px; display:block; margin:auto"/>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="file" accept="image/*" name="img" id="filePhoto" class="required borrowerImageFile" data-errormsg="PhotoUploadErrorMsg">
                </div>
                <div class="form-group mb-2">
                    <p>Texto: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <textarea name="content_unit" > </textarea>
                </div>     
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

{{--Modal for update a unit--}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar tema</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ action('UnitController@updateUnit') }}" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="id" name="id" value="">
                <div class="form-group mb-2">
                    <p>Titulo: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Titulo" id="name" name="name" maxlength="50" required>
                </div>
                <div class="form-group mb-2">
                    <p>Imagen actual:</p>
                    <img width="20%" id="img" name="img" style="max-width: 250px; display:block; margin:auto"/>
                </div>
                <div>
                    <p>Nueva imagen: </p><img id="previewHolder"  width="150px" height="150px" style="max-width: 150px; display:block; margin:auto"/>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="file" accept="image/*" name="img" value="" id="filePhoto" class="required borrowerImageFile" data-errormsg="PhotoUploadErrorMsg">
                </div>
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="modal-footer">
                    <input style="margin-top: 1rem" type="submit" class="btn btn-light" value="Cerrar" data-dismiss="modal"/>
                    <input style="margin-top: 1rem" type="submit" class="btn btn-info" value="Editar"/>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

{{-- Modal for update a unit_content
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar tema</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ action('UnitController@updateUnit') }}" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="id" name="id" value="">
                <div class="form-group mb-2">
                    <p>Titulo: </p>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" class="form-control" placeholder="Titulo" id="name" name="name" maxlength="50" required>
                </div>
                <div class="form-group mb-2">
                    <p>Imagen:</p><img id="uploadPreview" style="max-width: 250px; display:block; margin:auto;"/>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input name="img" type="file" id="uploadImage" class="form-control-file" accept="image/*" required onchange="PreviewImage();">
                </div>
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="modal-footer">
                    <input style="margin-top: 1rem" type="submit" class="btn btn-light" value="Cerrar" data-dismiss="modal"/>
                    <input style="margin-top: 1rem" type="submit" class="btn btn-info" value="Añadir"/>
                </div>
            </form>
        </div>
      </div>
    </div>
</div> --}}


{{--Modal for delete a unit--}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar tema</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ action('UnitController@deleteUnit') }}" role="form">
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

{{--Modal for delete a unit_content--}}
<div class="modal fade" id="deleteContentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar contenido de tema</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ action('UnitContentController@deleteUnitContent') }}" role="form">
            {{ method_field('DELETE') }}
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="modal-body">
                <input type="hidden" id="contentID" name="contentID" value="">
                <p id="contentName"></p>
            <div class="modal-footer">  
                <input style="margin-top: 1rem" type="button" class="btn btn-light" value="Cancelar" data-dismiss="modal"/>
                <input id='delete' style="margin-top: 1rem" type="submit" class="btn btn-danger deleteUser" value="Eliminar">
            </div>
        </form>
      </div>
    </div>
</div>

@endsection