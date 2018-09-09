
<!--Section: Contact v.3-->
<section class="section mb-5 pt-5">

    <!--Grid row-->
    <div class="row" <?php if(!$isLogged){ ?>  style="margin-top: 50px;" <?php } ?>>

        <!--Grid column-->
        <div class="col-md-12">

            <!--Form with header-->
            <div class="card">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-body form">
                            <!--Header-->
                            <div class="formHeader mb-1 pt-3">
                                <h3><i class="fa fa-envelope"></i> Contact us:</h3>
                            </div>

                            <br>

                            <form>
                                <!--Grid row-->
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <div class="md-form">
                                                <input type="text" id="txtName" class="form-control" <?= isset($user->NAME)?'disabled':''; ?> value="<?= isset($user)?$user->NAME:''; ?>" maxlength="100">
                                                <label id="lblName" for="txtName" class="">Your name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Grid column-->

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <div class="md-form">
                                                <input type="email" id="txtEmail" class="form-control" <?= isset($user->EMAIL)?'disabled':''; ?> value="<?= isset($user)?$user->EMAIL:''; ?>" maxlength="100">
                                                <label id="lblEmail" for="txtEmail" class="">Your email</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Grid column-->

                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <div class="md-form">
                                                <input type="text" id="txtPhone" class="form-control" <?= isset($user->PHONE)?'disabled':''; ?> value="<?= isset($user)?$user->PHONE:''; ?>" maxlength="12">
                                                <label id="lblPhone" for="txtPhone" class="">Your phone</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Grid column-->

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form">
                                            <div class="md-form">
                                                <input type="text" id="txtCompany" class="form-control" <?= isset($user->CUSTOMER_NAME)?'disabled':''; ?> value="<?= isset($user)?$user->CUSTOMER_NAME:''; ?>" maxlength="2000">
                                                <label id="lblCompany" for="txtCompany" class="">Your company</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Grid column-->

                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-12">

                                        <div class="md-form">
                                            <textarea type="text" id="txtMessage" class="md-textarea"></textarea>
                                            <label id="lblMessage" for="txtMessage">Your message</label>
                                            <a class="btn-floating btn-lg pm_test-red" id="btnContactSend"><i class="fa fa-send-o"></i></a>
                                        </div>

                                    </div>
                                    <!--Grid column-->

                                </div>
                                <!--Grid row-->
                            </form>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card-body contact text-center pm_test-blue">
                            <div class="container">
                                <div class="mb-5">
                                    <h3><?= $contact['heading']; ?></h3>
                                </div>

                                <ul class="contact-icons">
                                    <li><i class="fa fa-map-marker "></i>
                                        <p><?= $contact['address1'].", ".$contact['address2']; ?></p>
                                        <p class="m-4">  <?= $contact['city']; ?>, <?= $contact['state']; ?>, <?= $contact['postal']; ?>, <?= $contact['country']; ?>
                                        </p>
                                    </li>

                                    <li><i class="fa fa-phone"></i>
                                        <p><?= $contact['phone']; ?></p>
                                    </li>

                                    <li><i class="fa fa-envelope"></i>
                                        <p><?= $contact['email']; ?></p>
                                    </li>
                                </ul>

                                <hr class="hr-light mb-4 mt-4">

                                <ul class="inline-ul text-center list-unstyled">
                                    <?php foreach($social as $s => $l){ ?>
                                        <li><a class="icons-sm" href="<?= $l; ?>" class="icons-sm tw-ic" target="_blank"><i class="fa fa-<?= $s; ?>"> </i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Form with header-->

        </div>
        <!--Grid column-->

    </div>
    <!--Grid row-->

</section>
<!--Section: Contact v.3-->

<script type="text/javascript">
    <?php $this->load->view("js/contact.js"); ?>
</script>

            