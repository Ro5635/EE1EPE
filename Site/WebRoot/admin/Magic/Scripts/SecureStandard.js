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

    $('.ButtonsBlock').click(function() {
        $ID = $(this).attr('id');



        if( $(this).hasClass("AuthoriseButton") ){
                //Autharise the message:
                var data = 'task=8&mid=' + $ID;
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
            } else if ( $(this).hasClass("DeleteButton") ){
                //Delete the message:
                var data = 'task=9&mid=' + $ID;
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
}


$(document).ready(main()); 