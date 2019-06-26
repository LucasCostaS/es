"use strict";

$(document).ready(function() {

    $(".alert").each(function() {

        var $alert = $(this);

        setTimeout(function() {
           
            $alert.removeClass('fadeInDown').addClass('fadeOutUp');
            
            setTimeout(function() {
                $alert.remove();
            }, 600);

        }, 5000);

    });
    
});