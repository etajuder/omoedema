$(document).ready(function(){
   $('#preview').on('click',function(){
       var web =$('#website').val();
       $.ajax({
            url: $(this).data('url'),
            data: {web:web},
            type: 'POST',
            success: function(data, textStatus, jqXHR) {
                data = JSON.parse(data);
                $('#link-title').html(data.title);
                $('#desc').html(data.description);
                $('#img-link').attr('src',(data.image[0]));
            }
       });
   }); 
});

