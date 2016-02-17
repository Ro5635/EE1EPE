//This javascript script utilises the jqurey lib to make the site somewhat interactive:

var main = function(){
    $('#SendMessageForm').submit( function(){
        var FormData = $(this).serialize();


        $.post('AJAXEditProduct.php' ,FormData ,ProccessData);

        //Now re-set the form
        $('#SendMessageFormContainer').slideUp('slow');
        return false;


    });

    function ProccessData(){
        
    }
}

$(document).ready(main()); 