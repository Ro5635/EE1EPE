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
            var data = '?t=8&mid=' . $ID;
            $.ajax({
                url: "authorise.php",
                type: "POST",
                data: data,
                cache: false,
                success: function(reternedData) {

                }


            })} else if ( $(this).hasClass("DeleteButton") ){
            //Delete the message:
            $ID = $(this).attr('id');
            if( $(this).hasClass("AuthoriseButton") ){
            //Autharise the message:
            var data = '?t=9&mid=' . $ID;
            $.ajax({
                url: "authorise.php",
                type: "POST",
                data: data,
                cache: false,
                success: function(reternedData) {

                }

            }

            );
        }
    }
}
}

$(document).ready(main()); 