$(document).ready(function() {
    var txtName         = $('#txtName');
    var txtEmail        = $('#txtEmail');
    var txtPhone        = $('#txtPhone');
    var txtCompany      = $('#txtCompany');
    var txtMessage      = $('#txtMessage');

    var lblName         = $('#lblName');
    var lblEmail        = $('#lblEmail');
    var lblPhone        = $('#lblPhone');
    var lblCompany      = $('#lblCompany');
    var lblMessage      = $('#lblMessage');

    $(document).on("click","#btnContactSend", function(e) {
        var isValid = true;
        if(txtName.val() == ''){
            txtName.addClass('border-bottom border-danger');
            lblName.addClass('text-danger');
            isValid = false;
        }else{
            txtName.removeClass('border-bottom border-danger');
            lblName.removeClass('text-danger');
        }
        if(txtEmail.val() == ''){
            txtEmail.addClass('border-bottom border-danger');
            lblEmail.addClass('text-danger');
            isValid = false;
        }else{
            txtEmail.removeClass('border-bottom border-danger');
            lblEmail.removeClass('text-danger');
        }
        if(txtPhone.val() == ''){
            txtPhone.addClass('border-bottom border-danger');
            lblPhone.addClass('text-danger');
            isValid = false;
        }else{
            txtPhone.removeClass('border-bottom border-danger');
            lblPhone.removeClass('text-danger');
        }
        if(txtCompany.val() == ''){
            txtCompany.addClass('border-bottom border-danger');
            lblCompany.addClass('text-danger');
            isValid = false;
        }else{
            txtCompany.removeClass('border-bottom border-danger');
            lblCompany.removeClass('text-danger');
        }
        if(txtMessage.val() == ''){
            txtMessage.addClass('border-bottom border-danger');
            lblMessage.addClass('text-danger');
            isValid = false;
        }else{
            txtMessage.removeClass('border-bottom border-danger');
            lblMessage.removeClass('text-danger');
        }

        var data = {
            data: {
                NAME    : txtName.val(),
                EMAIL   : txtEmail.val(),
                PHONE   : txtPhone.val(),
                COMPANY : txtCompany.val(),
                MESSAGE : txtMessage.val(),
            }
        };
        if(isValid){
            $.ajax({
                cache: false,
                url: base_url+'/contact/send',
                type: 'POST',
                data: data,
                success: function(result){
                    if(result['code']  == 'SUCCESS'){
                        toastr.success(result['data']['message'], result['code']);
                        txtMessage.val('');
                        $('#btnContactSend').disabled();

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