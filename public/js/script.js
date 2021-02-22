(function( $ ){

    var $body;

    $(document).ready(function(){
        $body = $('body');

        $body
            .find('.phone-number').each(function(){
            $(this).mask("+7 (777) 777-77-77", {autoсlear: false});
        });

        $body.on('keyup','.phone-number',function(){
            var phone = $(this),
                phoneVal = phone.val(),
                form = $(this).parents('form');

            if ( (phoneVal.indexOf("_") != -1) || phoneVal == '' ) {
                form.find('.btn_submit').attr('disabled',true);
            } else {
                form.find('.btn_submit').removeAttr('disabled');
            }
        });

    });

})( jQuery );
