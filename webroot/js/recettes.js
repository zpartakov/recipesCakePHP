/**
* @version        $Id: recettes.js v1.0 07.03.2011 06:25:39 CET $
* @package        recettes.akademia.ch
* @copyright    Copyright (C) 2009 - 2013 Open Source Matters. All rights reserved.
* @license        GNU/GPL, see LICENSE.php
* Эrgolang is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*
* Main recettes.akademia.ch javascript
*/


function vide_recherche(id) {
	document.getElementById(id).value="";
}

/* #################### NEW AJAX JQUERY #################### */

/*
 * a function to search if the title is unique or not; if not, warns and give a link to the recipe matching
* */

function checkunik(value) {
	$.ajax({
	   type: "GET",
	   url: "/recettes3/recettes/cherchetitre?titre="+value,
       dataType: "html",   //expect html to be returned                
	   error:function(msg){
		 alert( "Error !: " + msg );
	   },
	   success:function(data){
		            $("#responsecontainer").html(data); 
		   lid="#tr"+id;		   
		   $(lid).fadeOut();
		}
	});
	
	
}

/*
$(document).ready(function(){
$(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('#gotop').fadeIn();
        } else {
            $('#gotop').fadeOut();
        }
    });

    $('#gotop').click(function() {
        $('body,html').animate({scrollTop:0},800);
    });
});
*/
