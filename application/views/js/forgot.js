$(document).ready(function() {
    var txtEmail        = $('#txtEmail');
    var lblEmail        = $('#lblEmail');

    $(document).on("click","#btnSend", function(e) {
        var isValid = true;
        if(txtEmail.val() == ''){
            txtEmail.addClass('border-bottom border-danger');
            lblEmail.addClass('text-danger');
            isValid = false;
        }else{
            txtEmail.removeClass('border-bottom border-danger');
            lblEmail.removeClass('text-danger');
        }

        var data = {
            data: {
                EMAIL: txtEmail.val(),
            }
        };
        if(isValid){
            $.ajax({
                cache: false,
                url: base_url+'/services/authenticate/send_password',
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