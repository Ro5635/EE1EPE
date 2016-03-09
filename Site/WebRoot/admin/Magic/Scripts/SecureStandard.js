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



        


        

}


$(document).ready(main()); 