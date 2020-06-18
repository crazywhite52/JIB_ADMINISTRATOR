<?php $baseUrl=Yii::app()->request->baseUrl; 
$id=Yii::app()->request->cookies['cookie_user_id']->value;
?>
<link rel="stylesheet" href="<?php echo $baseUrl; ?>/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Job
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->createUrl("site/index"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Create Job</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-2" style="padding-bottom: 5px;"><button type="button" id="save" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> บันทึกข้อมูล</button></div>
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">กรอกข้อมูล</h3>
        </div>
        <!-- /.box-header -->
        <?php echo CHtml::hiddenField("id", ($data["id"]) ? $data["id"] : null, array()) ?>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label>ชื่อ งาน,โปรเจค,โปรแกรม</label>
              <?php echo CHtml::textField("title", ($data["title"]) ? $data["title"] : null, array("class" => "form-control")); ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class="col-md-6" style="padding-left: 0px;">
              <div class="form-group">
                <label>วันที่เริ่ม:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <?php $now=date("d/m/Y");
                  $cookie_user_id=Yii::app()->request->cookies['cookie_user_id']->value;
                  ?>
                  <?php echo CHtml::textField("startdate", ($data["startdate"]) ? MyClass::convertDate($data["startdate"]) : $now, array("id" => "datepicker1","class"=>"form-control")); ?>
                </div>
              </div>
            </div>

            <div class="col-md-6" style="padding-right: 0px;padding-left: 0px;">
              <div class="form-group">
                <label>วันที่สิ้นสุด:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <?php echo CHtml::textField("enddate", ($data["enddate"]) ? MyClass::convertDate($data["enddate"]) : $now, array("id" => "datepicker2","class"=>"form-control")); ?>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>ระดับงาน:</label>
              <?php echo CHtml::dropDownList("level", ($data["level"]) ? $data["level"] : null, Centerdb::levellist(),array("class"=> "form-control select2")); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>URL:</label>
              <?php echo CHtml::textField("url", ($data["url"]) ? $data["url"] : null, array("class" => "form-control")); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>ผู้รับงาน:</label>
              <?php echo CHtml::dropDownList("personal_id", ($data["contact"]) ? $data["contact"] : $cookie_user_id, PersonalProfile::Listpersonal(), array("class" => "form-control select2")); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>ชื่อโปรแกรม:</label>
              <?php echo CHtml::dropDownList("project", ($data["project"]) ? $data["project"] : null, Centerdb::Projectlist(), array("class" => "form-control select2")); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">รายละเอียด
            <small>ข้อมูล job</small>
          </h3>
        </div>
        <div class="box-body pad">
          <?php echo CHtml::textArea("editor1", $data["detail"] ? base64_decode($data["detail"]) : null, array("cols" => 80, "rows" => 10, "placeholder" => "รายละเอียดเพิ่มเติม", "value" => "detail")); ?>
        </div>
      </div>
      <!-- CK Editor -->
      <script src="<?php echo $baseUrl; ?>/adminLTE/bower_components/ckeditor/ckeditor.js"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <script src="<?php echo $baseUrl; ?>/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <?php echo CHtml::scriptFile("$baseUrl/js/ckeditor/ckfinder/ckfinder.js"); ?>
      <script>
        CKEDITOR.replace('editor1',
        {
          height: 260,
          filebrowserBrowseUrl: '<?php echo $baseUrl; ?>/js/ckeditor/ckfinder/ckfinder.html',
          filebrowserImageBrowseUrl: '<?php echo $baseUrl; ?>/js/ckeditor/ckfinder/ckfinder.html?Type=Images',
          filebrowserUploadUrl: '<?php echo $baseUrl; ?>/js/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/misadmin/file/',
          filebrowserImageUploadUrl: '<?php echo $baseUrl; ?>/js/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/misadmin/file/',
        });

      </script>
    </div>
  </div>
</section>
<script type="text/javascript" charset="utf-8" async defer>
  $(document).ready(function(){
    $("#save").click(function(){
      var title = $("#title").val();
      var startdate = $("#datepicker1").val();
      var enddate = $("#datepicker2").val();
      var level = $("#level").val();
      var url = $("#url").val();
      var personal_id = $("#personal_id").val();
      var project = $("#project").val();
      var editor1 = CKEDITOR.instances.editor1.getData();
      var id_hd = $("#id").val();
            //alert();

            if(title==''){
              swal("ชื่อหัวข้อ : ห้ามเป็นค่าว่าง!", "You clicked the button!", "error");
              return false;
            }if(level==''){
              swal("ระดับ : ห้ามเป็นค่าว่าง!", "You clicked the button!", "error");
              return false;
            }if(personal_id==''){
              swal("ผู้รับงาน : ห้ามเป็นค่าว่าง!", "You clicked the button!", "error");
              return false;
            }

            swal({
              title: "ยืนยันการบันทึกข้อมูล",
              text: "Submit to run save and send email",
              type: "info",
              showCancelButton: true,
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {

              $.post("<?php echo $this->createUrl("createjob/datasave"); ?>", { save:"true",title: title, startdate: startdate ,enddate : enddate,level:level,url:url,personal_id:personal_id,project:project,editor1:editor1,id_hd:id_hd })
              .done(function( data,status ) {
                if(data=='Message sent!'){
            //swal("บันทึกข้อมูลสำเร็จ!", "You clicked the button!", "success");
            setTimeout(function () {
              swal("บันทึกข้อมูลสำเร็จ!", "You clicked the button!", "success");
              window.location.href = "http://172.18.0.30/admin2018/index.php/site/index";
              //location.reload();
            }, 2000);
          }else{
            swal(data, "You clicked the button!", "error");
            return false;
            location.reload();
          }
        });

            });

          });
    $('#datepicker1').datepicker({
      autoclose: true,
      format:'dd/mm/yyyy'
    });
    $('#datepicker2').datepicker({
      autoclose: true,
      format:'dd/mm/yyyy'
    });
  });
</script>