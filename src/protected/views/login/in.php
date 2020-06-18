<?php
$baseUrl=Yii::app()->request->baseUrl; 
?>
<style>
div.transbox {
  background-color: #ffffff;
  border: 1px solid black;
  opacity: 0.8;
  filter: alpha(opacity=60); /* For IE8 and earlier */
}

div.transbox p {
  font-weight: bold;
  color: #000000;
}
</style>
<div class="login-box">
  <div class="login-logo">
    <a href="#" style="color: white"><b>JIB</b> AdminMIS</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body transbox" style="border-radius: 25px;">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php if (!empty($msg)): ?>
<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <?php echo $msg; ?>
              </div>
<?php endif ?>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="user_id" placeholder="ID">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="user_password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="chkaccess" value="28"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo $baseUrl;?>/adminLTE/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>