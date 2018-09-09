<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/img/favicon.png">
    <title>Postmedia Inc : Test : <?= $pageTitle; ?></title>

    <link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/mdb/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?=base_url()?>assets/mdb/css/mdb.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">

    <script type="text/javascript" src="<?=base_url()?>assets/mdb/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/mdb/js/bootstrap.min.js"></script>


    <script type="text/javascript">
        var base_url = '<?= base_url(); ?>' ;
        var body = $('body');
    </script>

</head>

<body class="<?php if($isLogged && $showSideNavigation){ ?>fixed-sn <?php } else { ?> pm_test-background <?php } ?> white-skin ">

	<?php if($showTopNavigation){ $this->load->view('_header'); } ?>

	<!--Main layout-->
	<main  style="min-height: 620px; <?php if(!$showSideNavigation){ ?> margin-top: 88px; <?php } ?>" >
		<div class="container-fluid">
			<?php if($showTopSubNavigation) { $this->load->view('_top_sub_navigation'); } ?>
			<?php if($view != '') { $this->load->view($view); } ?>
		</div>
	</main>
	<!--/Main layout-->

	<?php $this->load->view('_footer'); ?>

	<script type="text/javascript" src="<?=base_url()?>assets/mdb/js/mdb.min.js"></script>
	<script type="text/javascript">

			// SideNav Initialization
			$(".button-collapse").sideNav();
			new WOW().init();

			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			});

			<?php

			if(isset($flashData)){
				if(isset($flashData)){
					foreach ($flashData as $flashKey => $flashVal){
						echo "toastr.".$flashKey."('".$flashVal."');";

					}
				}
			}
			?>

	</script>


</body>

</html>
