console.log('load');
$(document).ready(function(){
    $('.open-deleteDialog').click(function(){
        var userID = $(this).data('id');
        $('#deleteModal').modal('toggle');
        console.log( userID);
        $(".modal-body #userID").val( userID );
        var userName = $(this).data('name');
        $(".modal-body #userName").text("¿Quiéres eliminar " + userName  + "?");
    });

    $('.open-deleteContent').click(function(){
        var userID = $(this).data('id');
        $('#deleteContentModal').modal('toggle');
        $(".modal-body #contentID").val( userID );
        console.log(userID);
        var userName = $(this).data('name');
        $(".modal-body #contentName").text("¿Quiéres eliminar " + userName  + "?");
    });

    $('.deleteUser').click(function() {
        console.log('delete');
        $('body').css('cursor', 'progress');
    });
});