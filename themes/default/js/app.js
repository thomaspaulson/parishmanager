// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

$(function() {
	
    function baseURL(){
        $base = document.getElementsByTagName('base');
        return $base[0].href;    	
    }
	
	/*
    var projects = [
        {
            value: "jquery",
            label: "jQuery",
            desc: "the write less, do more, JavaScript library",
            icon: "jquery_32x32.png"
        },
        {
            value: "jquery-ui",
            label: "jQuery UI",
            desc: "the official user interface library for jQuery",
            icon: "jqueryui_32x32.png"
        },
        {
            value: "sizzlejs",
            label: "Sizzle JS",
            desc: "a pure-JavaScript CSS selector engine",
            icon: "sizzlejs_32x32.png"
        }
    ];


    $( "#YourParish " ).autocomplete({
        minLength: 0,
        source: 'parish/search',
        focus: function( event, ui ) {
            // $( "#YourParish" ).val( ui.item.title + ", " +  ui.item.location  );
            return false;
        },
        select: function( event, ui ) {
            $( "#YourParish" ).val( ui.item.title + ", " +  ui.item.location );
            //$( "#project-id" ).val( ui.item.value );
            //$( "#project-description" ).html( ui.item.desc );
            //$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
            $base = document.getElementsByTagName('base');
            var $baseurl = $base[0].href;
            var $redirecturl = '?BackURL=' + encodeURIComponent(window.location.href);
            //console.log($redirecturl);
            window.location.href = $baseurl + 'parish/myparish/' + ui.item.id + $redirecturl;
            return false;
        }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<a>" + item.title + ", " +  item.location  +  "</a>" )
            .appendTo( ul );
    };

    $('#myParish').hide();
    var $myParish = 'hidden';

    
    $('#myParishHandler').click(function(event ){
            event.preventDefault();
            if($myParish=='hidden'){
                $('#myParish').slideDown(500);
                $myParish = 'reveal';
            }
            else{
                $('#myParish').slideUp(500);
                $myParish = 'hidden';
            }
        }
    );
    */
	
    $('[name="action_doCancel"]').click(function(event) {    	
    	event.preventDefault;
    	$redirecturl = baseURL() + $('[name="RedirectURL"]').val();
    	window.location.href = $redirecturl;
    	return false;
    });
	
	$('[name="HoldsRationCard"]').change(function(){
		if($(this).val() == 1){
			$('[name="CardType"]').prop( "disabled", false );
		}		
	});
	

});
