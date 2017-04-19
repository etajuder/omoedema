$("body").on("change","#album_photo",function(event){
    var me = $(this);
    var albums = $("#albums");
    var template = $("#template");
    var form = $("#photo_form");
    form.ajaxSubmit({
        url: base_path+"requests/upload_photo",
        type: "POST",
        success: function(data){
            data = JSON.parse(data);
            if(data.image !== ""){
                 
                albums.val(albums.val()+";"+data.image);
                template.append("<div class='col-md-3'><img src='"+data.image+"' style='width:100%;height:90px;' /></div>")
            }else{
                alert("i dont understand");
            }
        }
    });
});