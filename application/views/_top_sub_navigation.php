<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark pm_test-blue">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="#"><?= $pageTitle; ?></a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse"  id="navbarSupportedContent">

        <!-- Links -->
        <ul class="navbar-nav mr-auto" style="margin-left: 50px;">
            <?php
                foreach ($topSubNavigation as $title => $link) {
            ?>
            <li class="nav-item <?= current_url()==base_url($subFolder.'/'.$link)?'active':'' ?>">
                <a class="nav-link" href="<?= base_url($subFolder.'/'.$link); ?>"><?= ucfirst($title); ?>&nbsp;</a>
            </li>
            <?php
                }
            ?>
        </ul>
        <?php if (trim($view) == "sc/list") {?>
            <ul class="navbar-nav">   
                <li class="nav-item">
                    <a class="nav-link" href="#" id="btnExportExcel"><?php echo cs_lang("sc_excel");?></a>
                </li>                            
            </ul>
        <?php } ?>
        <!-- Links -->

    </div>
    <!-- Collapsible content -->

</nav>
<!--/.Navbar-->

<script type="text/javascript">
    /**
     * Export
     */
    $(document).on("click","#btnExportExcel", function(e){        
        var filters = $('#form-filters').serializeJSON(); 

        url = Object.keys(filters).map(function(k) {
            return 'filter[' + encodeURIComponent(k) + ']' + '=' + encodeURIComponent(filters[k])
        }).join('&');        

        window.open("<?php echo base_url('service_call'); ?>/exportExcel?"+url);
    }); 


    // Not implemented yet. 
    $(document).on("click","#btnExportPDF", function(e){        
        window.open("<?php echo base_url('service_call'); ?>/exportPDF");
    });        
</script>

<style type="text/css">
    .dropdown-menu {
        left: auto;
        right: 0px;
    }
</style>