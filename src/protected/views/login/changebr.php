<?php
$baseUrl=Yii::app()->request->baseUrl; 
$cookies_id = Yii::app()->request->cookies['cookie_user_id']->value;
?>
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>JIB</b> ระบบปริ้นสติกเกอร์</a>
  </div>



    <form action="<?php $this->createUrl("logging/changebr"); ?>" method="post">
     <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">เปลียน สาขา ปริ้นสติ๊กเกอร์</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-3">
                  <?php echo CHtml::textField("id_br", Yii::app()->request->cookies['sticker_branch']->value, array("class" => "form-control")); ?>
                </div>
                <div class="col-xs-6">
                 <?php echo CHtml::dropDownList("branch", Yii::app()->request->cookies['sticker_branch']->value, Branch::BranchList(), array("class" => "form-control", "style" => "width:250px ")); ?>
                </div>
               
              </div>
            </div>
            <!-- /.box-body -->
          </div>
      <div class="row">
        <input type="hidden" id="userid" name="userid" value="<?php echo $cookies_id; ?>" > 
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">SAVE</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


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
     $("#branch").change(function () {
        $("#id_br").val($("#branch").val());
    });
    $("#id_br").keyup(function () {
        $("#branch").val($("#id_br").val());
    });
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  
</script>