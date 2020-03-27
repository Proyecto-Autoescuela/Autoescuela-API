console.log('Edit dialog');
$(document).ready(function(){
    $('.open-editDialog').click(function(){
        $('#editModal').modal('toggle');
        var id = $(this).data('id');
        $(".modal-body #id").val( id );
        var name = $(this).data('name');
        $(".modal-body #name").val( name );
        var img = $(this).data('image');
        $(".modal-body #img").attr( 'src', img );
        console.log( img );
        var email = $(this).data('email');
        $(".modal-body #email").val( email );
        var teacher_id = $(this).data('teacher_id');
        $(".modal-body #teacher").val( teacher_id );
        var license = $(this).data('license');
        $(".modal-body #license").val( license );
    });
});
