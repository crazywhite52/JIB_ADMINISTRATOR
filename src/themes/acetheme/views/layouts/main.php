<?php
@ob_start();
@session_start(); 
$baseUrl=Yii::app()->request->baseUrl; 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrator</title>
  <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/images/Name-tag-admin-1000.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap/dist/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/dist/css/skins/_all-skins.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Morris charts -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/morris.js/morris.css">
  <!-- sweetalert -->
  <link href="<?php echo $baseUrl;?>/assets/dist/sweetalert.css" rel="stylesheet">
  <script src="<?php echo $baseUrl;?>/assets/dist/sweetalert.min.js"></script>

  <link rel="stylesheet" href="<?php echo $baseUrl;?>/font/sans.css">
  <link href="<?php echo $baseUrl;?>/assets/dist/sweetalert.css" rel="stylesheet">
  <script src="<?php echo $baseUrl;?>/assets/dist/sweetalert.min.js"></script>
  <script src="<?php echo $baseUrl;?>/assets/jquery-2.1.4.min.js"></script>

  <script src="<?php echo $baseUrl;?>/nodejs/socket-io.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <div class="wrapper">
<?php $this->beginContent("//layouts/navbar");$this->endContent();?>
<?php $this->beginContent("//layouts/sidebar");$this->endContent();?>
     <div class="content-wrapper">

        <?php echo $content;?>

      </div>
      <?php #$this->beginContent("//layouts/chatbox");$this->endContent();?>
 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="#">Management Information System (MIS) By JIB</a>.</strong> All rights
    reserved.
  </footer>

   <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<script src="<?php echo $baseUrl;?>/assets/jquery-2.1.4.min.js"></script>
<!-- jQuery 3 -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo $baseUrl;?>/adminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo $baseUrl;?>/adminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo $baseUrl;?>/adminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo $baseUrl;?>/adminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo $baseUrl;?>/adminLTE/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $baseUrl;?>/adminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $baseUrl;?>/adminLTE/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/morris.js/morris.min.js"></script>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.base.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.energyblue.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.ui-smoothness.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.metrodark.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.bootstrap.css"); ?>
        <?php echo CHtml::cssFile($baseUrl . "/js/jqwidgets/jqwidgets/styles/jqx.metro.css"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcore.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxbuttons.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxchart.core.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdraw.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdata.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxeditor.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxscrollbar.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxmenu.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxinput.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcheckbox.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxlistbox.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdropdownlist.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxdatetimeinput.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxcalendar.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxwindow.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.sort.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.edit.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.storage.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.selection.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.filter.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.columnsresize.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.columnsreorder.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.pager.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.grouping.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxgrid.aggregates.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/jqxtooltip.js"); ?>
        <?php echo CHtml::scriptFile($baseUrl . "/js/jqwidgets/jqwidgets/globalization/globalize.js"); ?>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
