var main = function(){ 

    function AJAXEvent(){
        //Autharise the message:
        var data = 't=10';
        $.ajax({
            url: "crossdomainapi.php",
            type: "POST",
            data: data,
            cache: false,
            success: function(reternedData) {
                $('#AJAXAuthTable').html('');
                $('#AJAXAuthTable').html(reternedData);
            }
        });

    }

        $('#AJAXAuthTable').on( "click", '.ButtonsBlock', function() {
            $ID = $(this).attr('id');
            if( $(this).hasClass("AuthoriseButton") ){
                //Autharise the message:
                var data = 't=8&mid=' + $ID;
                $.ajax({
                    url: "crossdomainapi.php",
                    type: "POST",
                    data: data,
                    cache: false,
                    success: function(reternedData) {

                    }
                });
                //Should do this in the call back, but time pressure...
                $(this).parent().slideUp('slow');
            } else if ( $(this).hasClass("DeleteButton") || $(this).hasClass("DeleteButtonPendingDisplay") ){
                //Delete the message:
                var data = 't=9&mid=' + $ID;
                $.ajax({
                    url: "crossdomainapi.php",
                    type: "POST",
                    data: data,
                    cache: false,
                    success: function(reternedData) {
                    }
                       
                    });
                 //Should do this in the call back, but time pressure...
                $(this).parent().slideUp('slow');
                
            }
        });


    window.setInterval(AJAXEvent, 5000);
}
    $(document).ready(main()); 