$(document).ready(function() {

    var txtCurrentPassword      = $('#txtCurrentPassword');
    var lblCurrentPassword      = $('#lblCurrentPassword');
    var txtNewPassword          = $('#txtNewPassword');
    var lblNewPassword          = $('#lblNewPassword');
    var txtConfirmNewPassword   = $('#txtConfirmNewPassword');
    var lblConfirmNewPassword   = $('#lblConfirmNewPassword');

    txtNewPassword.keyup(function(){
        if(txtNewPassword.val() != ''){
            $('#barPasswordStrength').html($.checkPasswordStrength($('#txtNewPassword').val()));
        }else {
            $('#barPasswordStrength').html('');
        }
    });
    txtConfirmNewPassword.keyup(function(){
        if(txtConfirmNewPassword.val() != '') {
            $('#barPasswordMatch').html($.matchPassword(txtNewPassword, txtConfirmNewPassword));
        } else {
            $('#barPasswordMatch').html('');
        }
    });
    $(document).on('focus', '#txtNewPassword',  function(e){
        $('#barPasswordStrength').show();
        //$('#barPasswordMatch').hide();
    });
    $(document).on('focus', '#txtConfirmNewPassword',  function(e){
        //$('#barPasswordStrength').hide();
        $('#barPasswordMatch').show();
    });

    $(document).on("click","#btnChangePassword", function(e) {
        var isValid = true;
        if(txtCurrentPassword.val()== '' ){
            txtCurrentPassword.addClass('border-bottom border-danger');
            lblCurrentPassword.addClass('text-danger');
            isValid = false;
        }else{
            txtCurrentPassword.removeClass('border-bottom border-danger');
            lblCurrentPassword.removeClass('text-danger');
        }
        if(txtNewPassword.val().length < 6){
            txtNewPassword.addClass('border-bottom border-danger');
            lblNewPassword.addClass('text-danger');
            toastr.error('New password can not be less then 6 ', 'Error');
            isValid = false;
        }else{
            txtNewPassword.removeClass('border-bottom border-danger');
            lblNewPassword.removeClass('text-danger');
        }
        if(txtConfirmNewPassword.val() == ''){
            txtConfirmNewPassword.addClass('border-bottom border-danger');
            lblConfirmNewPassword.addClass('text-danger');
            isValid = false;
        }else{
            txtConfirmNewPassword.removeClass('border-bottom border-danger');
            lblConfirmNewPassword.removeClass('text-danger');
        }
        if(txtNewPassword.val() !== txtConfirmNewPassword.val()){

            isValid = false;
            toastr.error('Passwords do not match', 'Error');
        }

        //var aa = $.sendAjaxRequest(1,'users/authenticate');
        var data = {
            data: {
                CURRENTPASSWORD:    txtCurrentPassword.val(),
                NEWPASSWORD:        txtNewPassword.val()
            }
        };
        if(isValid){
            $.ajax({
                cache: false,
                url: base_url+'/services/users/change_password',
                type: 'POST',
                data: data,
                success: function(result){
                    if(result['code']  == 'SUCCESS'){
                        window.location = base_url+result['data']['url'];
                    }
                    else{
                        toastr.error(result['data']['message'], result['code']); //{'positionClass' : 'toast-bottom-right'}
                    }
                },
                error: function(result) {

                },
                complete: function () {

                }
            });
        }
    });

});