//This javascript script utilises the jqurey lib to make the site somewhat interactive:

var main = function(){
//JQurey 

	$('.PrimaryNav ul li').hover(
 		 function() {
    	$(this).addClass("hover");
  		}, function() {
    	$(this).removeClass("hover");
  		}

	);


	//This block section is the mobile sites slide menu///
	var MenuStatus = false;//Used to track menu position

    $('#HamburgerContainer').click(function() {
    	
    	if(!MenuStatus){
    		//$('#banner').animate({left: "0px"}, 400);
    		$('#MainPageContent').animate({left: "295px"}, 400);
    		$('body').animate({left: "295px"}, 400);
        $('.MobileNav').animate({left: "295px"}, 400);
        
    		MenuStatus =true;
    	}else{
    		$('#MainPageContent').animate({left: "-295px"}, 400);
    		$('body').animate({left: "0px"}, 400);
        $('.MobileNav').animate({left: "-295px"}, 400);
    		MenuStatus =false;
    	}
    });

	// $('#HamburgerContainer').click(function() {
 //   		$('#banner').animate({left: "-295px"}, 400);
 //    	$('body').animate({left: "0px"}, 400);
 //    	MenuStatus =false;
 //   });


    $('#SendMessageForm').submit( function(){
        var FormData = $(this).serialize();


        $.post('AJAXPublic.php' ,FormData ,ProccessData);

        //Now re-set the form
        $('#SendMessageFormContainer').slideUp('slow');
        return false;


    });

    function ProccessData(){
        //Prep the form for the next user:
        $('#NameTextBox').val('');
        $('#UserMessage').val('');
        $('#emailAddressInput').val('');
        grecaptcha.reset();
        $('#SendMessageFormContainer').slideDown('slow');
        return false;
    }


}

$(document).ready(main()); 