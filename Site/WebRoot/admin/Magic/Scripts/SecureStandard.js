var main = function(){

    $('#registerNewDevice').submit( function(){
        var FormData = $(this).serialize();
        $.post('AJAXSecure.php' ,FormData ,RegisterNewDeviceReturnFunction);
        $('#NewDeviceName').text($("input[name=simpleName]").val());
        //Now re-set the form
        return false;
    });

    function RegisterNewDeviceReturnFunction($DeviceTocken){
        //Display the generated device token:
        $('#DeviceHashValue').text($DeviceTocken);
        console.log($DeviceTocken);
        $('.FormPartOne').slideUp('slow');
        $('.FormSecondStage').slideDown('slow');
        return false;
    }

    function AJAXEvent(){
        //Autharise the message:
        var data = 't=10';
        $.ajax({
            url: "authorise.php",
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
                    url: "authorise.php",
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
                    url: "authorise.php",
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