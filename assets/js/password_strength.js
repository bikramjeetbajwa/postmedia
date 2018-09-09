
(function($) {
    $.checkPasswordStrength = function(password) {
        var strength = 0;
        if (password.length < 6) {
            $('#result').removeClass();
            $('#result').addClass('short');
            var str = '<div class="progress" data-toggle="tooltip" data-placement="top" title="Short password !"><div class="progress-bar bg-danger" role="progressbar"  style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
            return str;
        }
        if (password.length > 7) strength += 1;

        //If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1;

        //If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1;

        //If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1;

        //if it has two special characters, increase strength value.
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;

        //Calculated strength value, we can return messages

        var str = '';
        //If value is less than 2
        if (strength < 2 )
        {
            $('#result').removeClass();
            $('#result').addClass('weak');
            //return 'Weak';
            str = '<div class="progress" data-toggle="tooltip" data-placement="top" title="Week password !"><div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';

        }
        else if (strength == 2 )
        {
            $('#result').removeClass();
            $('#result').addClass('good');
            str = '<div class="progress" data-toggle="tooltip" data-placement="top" title="Good password !"><div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>';
        }
        else
        {
            $('#result').removeClass();
            $('#result').addClass('strong');
            str = '<div class="progress" data-toggle="tooltip" data-placement="top" title="Strong password !"><div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
        }
        return str;
    }

    $.matchPassword = function(password, confirmPassword){
        if(password.val() === confirmPassword.val()){
            str = '<div class="progress" data-toggle="tooltip" data-placement="top" title="Passwords match !"><div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
        }
        else {
            str = '<div class="progress" data-toggle="tooltip" data-placement="top" title="Password do not match !"><div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
        }
        return str;
    }

    $.validatePassword = function(password){
        if(password.val().length < 6) {
            return false;
        }
    }


})(jQuery);
