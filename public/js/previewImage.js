
function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
};

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#previewHolder').attr('src', e.target.result);
      }
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  $("#filePhoto").change(function() {
    readURL(this);
  });