
<section class="section mb-5 pt-4">
    <div class="row m-3">
        <div class="col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="card-body form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form">
                                        <input type="password" id="txtCurrentPassword" class="form-control">
                                        <label id="lblCurrentPassword" for="txtCurrentPassword">Current password</label>
                                    </div>
                                    <div class="md-form">
                                        <input type="password" id="txtNewPassword" class="form-control">
                                        <label id="lblNewPassword" for="txtNewPassword">New password</label>
                                        <div id="barPasswordStrength"></div>
                                    </div>
                                    <div class="md-form">
                                        <input type="password" id="txtConfirmNewPassword" class="form-control">
                                        <label id="lblConfirmNewPassword" for="txtConfirmNewPassword">Confirm New password</label>
                                        <div id="barPasswordMatch"></div>
                                    </div>
                                    <div class="text-center ">
                                        <button class="btn pm_test-red float-right " id="btnChangePassword" name="btnChangePassword">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="<?=base_url()?>assets/js/password_strength.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        <?php
        if($user->CHANGE_PWD_FLAG == 'Y'){
            echo "toastr.warning('Change password is required.', 'Change Password !');";
        }
        ?>
    }

</script>
<script type="text/javascript">
    <?php $this->load->view("js/account/password.js"); ?>
</script>