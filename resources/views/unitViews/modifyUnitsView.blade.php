@extends('layouts.app')

@section('content')
@php( $units = \App\Unit::all())
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">MODIFICAR</div>
                <div class="card-body">
                    <form method="POST" action="{{ action('UnitController@updateUnit') }}" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <p>Selecciona el tema que quieres modificar</p>
                        <select class="form-control" style="max-width: 41rem" name="id" aria-describedby="basic-addon2" required>
                            <option value=""></option>
                            @foreach($units as $s)
                                <option value="{{$s->id}}">Tema {{$s->id}}: {{$s->name}}</option>
                            @endforeach
                        </select>
                        <br>
                        <div class="form-group mb-2">
                            <p>Titulo: </p>
                          </div>
                          <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" placeholder="Titulo" name="name" required>
                          </div>
                          <div class="form-group mb-2">
                            <p>Imagen:</p><img id="uploadPreview" style="max-width: 250px; display:block; margin:auto;"/>
                          </div>
                          <div class="form-group mx-sm-3 mb-2">
                            <input name="unit_url" type="file" id="uploadImage" class="form-control-file" accept="image/*" required onchange="PreviewImage();">
                          </div>
                          <div class="form-group mb-2">
                              <p>Texto: </p>
                          </div>
                          <div class="form-group mx-sm-3 mb-2">
                              <pre><textarea placeholder="Texto tema..." class="form-control" id="exampleFormControlTextarea1" name="content_unit" required></textarea><pre>
                          </div>     
                          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                          <input style="margin-top: 1rem" type="submit" class="btn btn-light btn-lg btn-block" value="ACTUALIZAR" />
                    </form>
                    <input style="margin-top: 1rem" type="button" class="btn btn-light btn-lg btn-block" value="ATRAS" onclick="location.href = '{{ route('units') }}'"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
  </script>