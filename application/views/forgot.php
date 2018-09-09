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
                                <h3><i class="fa fa-user mt-2 mb-2"></i> Forgot Password</h3>
                            </div>

                            <!--Body-->
                            <div class="md-form">
                                <i class="fa fa-envelope prefix pm_test-dark-grey-text"></i>
                                <input type="text" id="txtEmail" name="txtEmail" class="form-control" maxlength="100">
                                <label id="lblEmail" for="txtEmail" >Your email</label>
                            </div>
                            <div class="text-right">
                                <button class="btn pm_test-red btn-lg" id="btnSend" name="btnSend"> Send</button>
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
    <?php $this->load->view("js/forgot.js"); ?>
</script>