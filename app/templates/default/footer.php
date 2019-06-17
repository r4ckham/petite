<?php
/**
 * Sample layout.
 */
use Helpers\Assets;
use Helpers\Hooks;
use Helpers\Url as rl;

//initialise hooks
$hooks = Hooks::get();
?>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer fixed">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <?php //TODO USER HELPER?>
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <?php //TODO USER HELPER; ?>
        <?php //TODO USER HELPER ?>
        <li><a class="active" href="#control-sidebar-settings-tab" data-toggle="tab"><i class="icon-map-marker"></i> Gérer la carte </a></li>
        <?php //TODO USER HELPER; ?>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
           <div id="profile-info-container"></div>
        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <?php //TODO redirect ?>
        <div class="tab-pane fade in active" id="control-sidebar-settings-tab">
            <div id="dashboard-col-nav">
                <div id="dashboard-nav-up"></div>
                <div class="">
                    <div id="dashboard-emplacement" class=""></div>
                    <div id="dashboard-car" class=""></div>
                </div>
            </div>
        </div>
        <?php //endif;?>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
</body>



</div>

<!-- JS -->
<?php


//hook for plugging in javascript
$hooks->run('js');

//hook for plugging in code into the footer
$hooks->run('footer');
?>

</body>
</html>