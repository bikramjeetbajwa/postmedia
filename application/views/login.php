
<section >
    <div class="full-bg-img flex-center" >
        <div class="container">

            <div class="row" style="margin-top: 50px;">
                <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5" >

                    <!--Form with header-->
                    <div class="card wow fadeIn" data-wow-delay="0.2s">
                        <div class="card-body ">

                            <!--Header-->
                            <div class="form-header pm_test-red">
                                <h3><i class="fa fa-user mt-2 mb-2"></i> Log in</h3>
                            </div>

                            <!--Body-->
                            <div class="md-form">
                                <i class="fa fa-envelope prefix pm_test-dark-grey-text"></i>
                                <input type="text" id="txtEmail" name="txtEmail" class="form-control" maxlength="100" value="nomail@nomail.com">
                                <label id="lblEmail" for="txtEmail" >Your email</label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-lock prefix pm_test-dark-grey-text"></i>
                                <input type="password" id="txtPassword" name="txtPassword" class="form-control" maxlength="25" value="password">
                                <label id="lblPassword" for="txtPassword" >Your password</label>
                            </div>

                            <div class="text-right">
                                <button class="btn pm_test-red btn-lg" id="btnLogin" name="btnLogin"> Log in</button>
                                <hr>

                                    <div class="options text-right">
                                        <p >Forgot <a class="pm_test-blue-text" href="<?= base_url('login/forgot'); ?>">Password ?</a></p>
                                    </div>
                            </div>

                        </div>
                    </div>
                    <!--/Form with header-->
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    <?php $this->load->view("js/login.js"); ?>
</script>

