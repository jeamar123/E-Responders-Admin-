<?php 
    if (!$this->session->userdata('logged_in')) {
        header("location: ".base_url());     
    }
    header("Cache-Control", "no-cache, no-store, must-revalidate");

 ?>

<!DOCTYPE html>
<html ng-app="app">
    <!-- Links (CSS/STYLES) -->
    <?php $this->load->view('public/temp/head'); ?>

    <body class="skin-blue" main-container>
        <!-- header logo: style can be found in header.less -->
        <?php $this->load->view('public/temp/header') ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view('public/temp/left-sidebar-menu') ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" ng-view>

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- For alert embed container -->
        <div id="alert_tone_container" style="position: fixed;"></div> 

        <!-- Scripts -->
        <?php $this->load->view('public/temp/scripts') ?>

    </body>
</html>