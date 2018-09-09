$(document).ready(function() {
    var txtEmail        = $('#txtEmail');
    var lblEmail        = $('#lblEmail');
    var txtPassword     = $('#txtPassword');
    var lblPassword     = $('#lblPassword');

    $(document).on("click","#btnLogin", function(e) {
        var isValid = true;
        if(txtEmail.val() == ''){
            txtEmail.addClass('border-bottom border-danger');
            lblEmail.addClass('text-danger');
            isValid = false;
        }else{
            txtEmail.removeClass('border-bottom border-danger');
            lblEmail.removeClass('text-danger');
        }
        if(txtPassword.val() == ''){
            txtPassword.addClass('border-bottom border-danger');
            lblPassword.addClass('text-danger');
            isValid = false;
        }else{
            txtPassword.removeClass('border-bottom border-danger');
            lblPassword.removeClass('text-danger');
        }

        var data = {
            data: {
                EMAIL: txtEmail.val(),
                PASSWORD: txtPassword.val()
            }
        };
        if(isValid){
            $.ajax({
                cache: false,
                url: base_url+'login/authenticate',
                type: 'POST',
                data: data,
                success: function(result){
                    if(result['code']  == 'SUCCESS'){
                        window.location = base_url+result['data']['url'];
                    }
                    else{
                        toastr.error(result['data']['message'], result['code']);
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