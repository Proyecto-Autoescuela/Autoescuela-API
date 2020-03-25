@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">AÑADIR</div>
                <div class="card-body">
                     <form method="POST" action="{{ action('LessonController@addLesson') }}" role="form" enctype="multipart/form-data">
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
                          <input name="lesson_url" type="file" id="uploadImage" class="form-control-file" accept="image/*" required onchange="PreviewImage();">
                        </div>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <input style="margin-top: 1rem" type="submit" class="btn btn-light btn-lg btn-block" value="AÑADIR" />
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