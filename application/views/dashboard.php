<div class="container-fluid">
    <div class="row m-1 pm_test-red-text" >
        <div class="col-lg-6 col-md-6 col-sm-6" style=" margin-top:1%;" >
            <div id="chartLast10Days"></div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" style=" margin-top:1%;" >
            <div id="chartTotalCalls"></div>
        </div>
    </div>
    <div class="row m-1 pm_test-red-text" >

        <div class="col-lg-2"></div>
        <div class="col-lg-4 p-2">

        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url()?>assets/mdb/js/modules/chart.js"></script>

<script type="text/javascript">
    <?php $this->load->view("js/dashboard.js"); ?>
</script>