$('body').on('click', '[editable]', function(){
    
    var $el = $(this);
                
    var $input = $('<input/>').val( $el.text() );
    $el.replaceWith( $input );
    
    var save = function(){
        var $p = $('<p data-editable />').text( $input.val());
        var api_token = 24;
        var id = $(this).data('id');
        console.log(id);
         var name = $(this).data('name');
        var email = $(this).data('email');
        var teacher_id = $(this).data('teacher_id');
        var license = $(this).data('license');
        $input.replaceWith( $p );

        $.ajax({
            type:'POST',
            url:'/public/api/users/students/modify',
            data:{api_token:api_token, id:id, name:name, email:email, teacher_id:teacher_id, license:license},
            success:function(data){
               alert("Elemento modificado");
            }
         });
    };
    
    $input.one('blur', save).focus();
    
});

//hacer dos onchanges para cada select