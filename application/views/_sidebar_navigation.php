<!-- Sidebar navigation -->
<div id="slide-out" class="side-nav pm_test-sn-bg fixed mdb-sidenav" style="transform: translateX(0%);">
    <ul class="custom-scrollbar list-unstyled pm_test-dark-grey-text" style="max-height:100vh;">
        <!-- Logo -->
        <li>
            <div class="logo-wrapper waves-light waves-effect waves-light">
                <a href="#"><img src="<?=base_url()?>assets/img/pm_test_logo.png" class="img-fluid flex-center"></a>
            </div>
        </li>
        <!--/. Logo -->
        <!--Social-->
        <li>
            <ul class="social">
                <?php foreach($social as $s => $l){ ?>
                    <li><a href="<?= $l; ?>" class="icons-sm tw-ic" target="_blank"><i class="fa fa-<?= $s; ?>"> </i></a></li>
                <?php } ?>
            </ul>
        </li>
        <!--/Social-->
        <!--Search Form-->
        <li>
            &nbsp;
        </li>
        <!--/.Search Form-->
        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
                <?= $sidebar; ?>
            </ul>
        </li>
        <!--/. Side navigation links -->
    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
<!--/. Sidebar navigation -->