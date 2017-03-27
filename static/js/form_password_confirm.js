(function($){
    
    $(document).ready(
        function(){
            
            $('.field-password-confirm-indicator input[type="password"]').first().on(
                'keyup',
                function(event){

                    var value = $(this).val();
                    var points = 0;
                    
                    if (value.length >= 3 && value.length <= 10) {
                        points = value.length - 2;
                    }else if (value.length > 10) {
                        points = 8;
                    }
                    
                    if (value.match(/[A-Z]/) && value.match(/[a-z]/)) {
                        points = points + 3;
                    }
                    
                    if (value.match(/[A-Za-z]/) && value.match(/[0-9]/)) {
                        points = points + 3;
                    }
                    
                    if (value.match(/[ ]/)){
                        points = points + 3;
                    }
                    
                    if (value.match(/[-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/]/)){
                        points = points + 3;
                    }
                    
                    var percent = (100 / 20) * points;
                    $(this).parents('.field-password-confirm-indicator').find('.progress-bar').attr('style', 'width:' + percent + '%');
                    
                    if (points >= 0 && points <= 7) {
                        $(this).parents('.field-password-confirm-indicator').find('.progress-bar').removeClass('progress-bar-success').removeClass('progress-bar-warning').addClass('progress-bar-danger');
                        $(this).parents('.field-password-confirm-indicator').find('.progress-bar span').empty().append('Weak password');
                    }else if (points >= 8 && points <= 14) {
                        $(this).parents('.field-password-confirm-indicator').find('.progress-bar').removeClass('progress-bar-success').removeClass('progress-bar-danger').addClass('progress-bar-warning');
                        $(this).parents('.field-password-confirm-indicator').find('.progress-bar span').empty().append('Medium password');
                    }else if (points >= 15) {
                        $(this).parents('.field-password-confirm-indicator').find('.progress-bar').removeClass('progress-bar-danger').removeClass('progress-bar-warning').addClass('progress-bar-success');
                        $(this).parents('.field-password-confirm-indicator').find('.progress-bar span').empty().append('Strong password');
                    }

                }
            );
            
            
            /*
             * This is to validate the control as we need to
             * inpect two fields and the standard validator allows
             * for only a single value
             */
            $('.field-password-confirm-indicator input[name="confirm_password"], .field-password-confirm-indicator input[type="password"]').on(
                'keyup',
                function(event){

                    var $this = $(this);
                    var $group = $this.parent();
                    var $field = $this.parents('.field-password-confirm-indicator');

                    // check what the 'other' password field is to validate against
                    var $password = '';
                    if($this.attr('name') === 'confirm_password'){
                        $password = $field.find('input[type="password"]').first();
                    } else {
                        $password = $field.find('input[name="confirm_password"]').first();
                    }
                    
                    if ($this.val() != "") {
                        if ($this.val() != $password.val()) {
                            // add the error handler to the group
                            $group.removeClass('has-success').addClass('has-error');
                            $group.find('.form-control-feedback').removeClass('glyphicon-ok').addClass('glyphicon-remove');
                        } else {
                            // add the success handler to both groups to allow users to continue
                            $password.parent().removeClass('has-error').addClass('has-success').removeClass('has-feedback').find('.form-control-feedback').detach();;
                            $group.removeClass('has-error').addClass('has-success').removeClass('has-feedback').find('.form-control-feedback').detach();
                        }
                    }
                }
            )
            
        }
    );
    
})(jQuery);