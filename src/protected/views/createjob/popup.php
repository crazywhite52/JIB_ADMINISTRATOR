<?php $baseUrl=Yii::app()->request->baseUrl; 
$id=Yii::app()->request->cookies['cookie_user_id']->value;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Popup</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $baseUrl;?>/adminLTE/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue" style="background-color:#D2B48C ">
<?php 
$sql="SELECT * FROM
(SELECT a.id,a.level,a.title,c.program_name,b.level_name,a.startdate,a.enddate,a.contact,a.url,a.detail,a.`status` AS st,
      CONCAT(d.personal_name,' ',d.personal_lastname,' ',d.personal_nickname) as personal_name,a.upd,
      CASE
        WHEN a.status = 0 THEN 'In Process'
        WHEN a.status = 1 THEN 'Send'
        WHEN a.status = 2 THEN 'Checking'
        WHEN a.status = 3 THEN 'Success'
      END AS status 
       FROM es_title a
       LEFT JOIN es_levels b ON a.level = b.id
       LEFT JOIN sysprogram c ON a.project = c.id
       LEFT JOIN jibhr.personal_profile d ON a.contact = d.personal_id
       WHERE a.id='".$_GET['id']."'
       ";
       $sql.=") AS t";
       $res=Yii::app()->msystem->createCommand($sql)->queryRow();
 ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Job Description
        <small>รายละเอียดงาน</small>
      </h1>
    </section>
       <section class="content">
        <input type="hidden" name="personal_id" id="personal_id" value="<?php echo $res["contact"]; ?>">
        <input type="hidden" name="title" id="title" value="<?php echo $res["title"]; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $res['url']; ?>">
        <input type="hidden" name="id_job" id="id_job" value="<?php echo $_GET['id']; ?>">
        <div class="row">
        <?php if($res["st"]==0){ ?>
          <div class="col-md-2">
            <button type="button" id="sendjob" class="btn btn-success"><i class="fa fa-fw fa-calendar-check-o"></i> ส่งงาน</button>
            <input type="hidden" name="id_hd" id="id_hd" value="<?php echo $_GET['id']; ?>">
          </div>
        <?php  }else if($res["st"]==1){ ?> 
            <div class="col-md-2">
            <?php if($id==2433 or $id==8844){ ?> 
            <button type="button" id="examine" class="btn btn-success"><i class="fa fa-fw fa-calendar-check-o"></i> ตรวจงาน</button>
            <button type="button" id="nopass" class="btn btn-danger"><i class="fa fa-fw fa-calendar-check-o"></i> ไม่ผ่าน</button>
            <input type="hidden" name="id_hd2" id="id_hd2" value="<?php echo $_GET['id']; ?>">
            <?php }else{ ?> 
            <button type="button" class="btn btn-success" disabled><i class="fa fa-fw fa-calendar-check-o"></i> ตรวจงาน</button>
            <button type="button" class="btn btn-danger" disabled><i class="fa fa-fw fa-calendar-check-o"></i> ไม่ผ่าน</button>
            <?php } ?>
          </div>
        <?php }else if($res["st"]==2){ ?>
          <div class="col-md-2">
            <?php if($id==2433 or $id==8844){ ?>
            <button type="button" id="success" class="btn btn-success"><i class="fa fa-fw fa-calendar-check-o"></i> เสร็จงาน</button>
            <button type="button" id="nopass" class="btn btn-danger"><i class="fa fa-fw fa-calendar-check-o"></i> ไม่ผ่าน</button>
            <input type="hidden" name="id_hd3" id="id_hd3" value="<?php echo $_GET['id']; ?>">
            <?php }else{ ?>
            <button type="button" class="btn btn-success" disabled><i class="fa fa-fw fa-calendar-check-o"></i> เสร็จงาน</button>
            <button type="button" class="btn btn-danger" disabled><i class="fa fa-fw fa-calendar-check-o"></i> ไม่ผ่าน</button>
            <?php } ?>
          </div>
        <?php }else if($res["st"]==3){ ?>
        
        <?php } ?>
        </div>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $res['title'] ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        	<div class="col-md-12 col-sm-12 col-xs-12">
          <dl class="dl-horizontal ">
                <dt>ผู้รับงาน</dt>
                <dd><?php echo $res['personal_name'] ?></dd>
                <dt>วันที่เริ่ม</dt>
                <dd><?php echo $res['startdate']; ?></dd>
                <dt>วันที่ส่ง</dt>
                <dd><?php echo $res['enddate']; ?></dd>
                <dt>ชื่อโปแกรม</dt>
                <dd><?php echo $res['program_name']; ?></dd>
                <dt>ระดับ</dt>
                <dd><?php echo $res['level']; ?></dd>
                <dt>สถานะ</dt>
                <dd><?php echo $res['status']; ?></dd>
                <dt>URL</dt>
                <dd><a href="<?php echo $res['url']; ?>" target="_blank"><?php echo $res['url']; ?></a></dd>
              </dl>
              </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="col-md-12 col-sm-12 col-xs-12">
          	<?php echo base64_decode($res['detail']); ?>
          </div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>


<!-- jQuery 3 -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $baseUrl;?>/adminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $baseUrl;?>/adminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $baseUrl;?>/adminLTE/dist/js/demo.js"></script>
<script>
  $(function () {
    $("#sendjob").click(function(){
      var status=1;
      var id=$("#id_hd").val();
      var personal_id=$("#personal_id").val();
      var title=$("#title").val();
      var url=$("#url").val();
      $.post("<?php echo $this->createUrl("createjob/sendjob"); ?>", {status:status,id:id,personal_id:personal_id,title:title,url:url})
          .done(function( data,status ) {
             if(data=='Message sent!'){
              alert("บันทึกสำเร็จ");
              //window.close();
              window.opener.location.href = window.opener.location.href;
              if (window.opener.progressWindow)
             {
                window.opener.progressWindow.close()
              }
              window.close();
             }

          });
    });

    $("#examine").click(function(){
      //alert("ssdss");
      var status=2;
      var id=$("#id_hd2").val();
      var personal_id=$("#personal_id").val();
      var title=$("#title").val();
      var url=$("#url").val();
      $.post("<?php echo $this->createUrl("createjob/sendjob"); ?>", {status:status,id:id,personal_id:personal_id,title:title,url:url})
          .done(function( data,status ) {
             if(data=='Message sent!'){
              //alert("บันทึกสำเร็จ");
              location.reload();
              /*window.opener.location.href = window.opener.location.href;
              if (window.opener.progressWindow)
             {
                window.opener.progressWindow.close()
              }
              window.close();*/
             
             }
          });

    });
    $("#nopass").click(function(){
      //alert("ssdss");
      var status=0;
      var id=$("#id_job").val();
      var personal_id=$("#personal_id").val();
      var title=$("#title").val();
      var url=$("#url").val();
      $.post("<?php echo $this->createUrl("createjob/sendjob"); ?>", {status:status,id:id,personal_id:personal_id,title:title,url:url})
          .done(function( data,status ) {
             if(data=='Message sent!'){
              //alert("บันทึกสำเร็จ");
              location.reload();
              /*window.opener.location.href = window.opener.location.href;
              if (window.opener.progressWindow)
             {
                window.opener.progressWindow.close()
              }
              window.close();*/
             
             }
          });

    });
    $("#success").click(function(){
      var status=3;
      var id=$("#id_hd3").val();
      var personal_id=$("#personal_id").val();
      var title=$("#title").val();
      var url=$("#url").val();
      $.post("<?php echo $this->createUrl("createjob/sendjob"); ?>", {status:status,id:id,personal_id:personal_id,title:title,url:url})
          .done(function( data,status ) {
             if(data=='Message sent!'){
              alert("บันทึกสำเร็จ");
              window.opener.location.href = window.opener.location.href;
              if (window.opener.progressWindow)
             {
                window.opener.progressWindow.close()
              }
              window.close();
             }
              });
    });

  });
</script>
</body>
</html>
