<?php if($isLogged){ ?>
    <!--Double navigation-->
    <header>
        <?php if($showSideNavigation){ $this->load->view('_sidebar_navigation'); } ?>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            </div>
            <div class="breadcrumb-dn mr-auto">
                <p class="pm_test-dark-grey-text"><strong><a href="<?= base_url('account'); ?>" class="pm_test-red-text text-capitalize"><?= getName(); ?></a></strong>, Welcome to Postmedia Test portal !</p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto pm_test-dark-grey-text">
                <li class="nav-item">
                    <a href="<?= base_url('contact'); ?>" class="nav-link"><i class="fa fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact Us</span></a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('account'); ?>" class="nav-link"><i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Account</span></a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('account/logout'); ?>" class="nav-link"><i class="fa fa-sign-out"></i> <span class="clearfix d-none d-sm-inline-block">Log Off</span></a>
                </li>
            </ul>
        </nav>
        <!-- /.Navbar -->
    </header>
    <!--/.Double navigation-->
<?php } else {  ?>
    <header>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
            <div class="breadcrumb-dn mr-auto">
                <p class="pm_test-dark-grey-text">Welcome to Postmedia Test portal !</p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto pm_test-dark-grey-text">
                <li class="nav-item">
                    <a href="<?= base_url('contact'); ?>" class="nav-link"><i class="fa fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact Us</span></a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('login'); ?>" class="nav-link"><i class="fa fa-sign-in"></i> <span class="clearfix d-none d-sm-inline-block">Log In</span></a>
                </li>
            </ul>
        </nav>
        <!-- /.Navbar -->
    </header>
<?php } ?>