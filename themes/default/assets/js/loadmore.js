


/**
 * 
 * @type type For Load More functionality
 * @author Wapjude
 * 
 */



var LoadMore ={
      update:'',
    increment: 0,
    load:false,
    limit:5,
    loaded:0,
    id:'',
    data:'',
    response:'',
    totalUrl:'',
    autoload:false,
     reset:function(){
        LoadMore.init =0;
    },
    show:function(){
        
           $.ajax({
            url:$(LoadMore.id).data('url'),
            type: 'POST',
            data: {data:LoadMore.data,limit:LoadMore.limit},
            success: function(data, textStatus, jqXHR) {
                LoadMore.response = data;
                LoadMore.limit += LoadMore.increment;
                $(LoadMore.update).html(data);
                
            }
            
        });
        if(LoadMore.autoload == true){
            LoadMore.Autoload();
        }
            
    },
    getResponse:function(){
        return LoadMore.data;
    },
    setLimit: function(limit){
        LoadMore.limit = limit;
        
    },
    Init: function(){
        $.ajax({
            url: LoadMore.totalUrl,
            data: {loaded: LoadMore.limit},
            type: 'POST',
            success: function(data, textStatus, jqXHR) {
                data = JSON.parse(data);
                 
                
                
            }
        });
    },
    Autoload:function(){
                setInterval(function(){
                    LoadMore.Init();
                },3000);
        
    }
    
};
