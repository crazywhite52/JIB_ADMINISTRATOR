
<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<!-- <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery_notification/js/jquery_v_1.4.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery_notification/js/jquery_notification_v.1.js"></script>
<link href="<?php echo $baseUrl; ?>/js/jquery_notification/css/jquery_notification.css" type="text/css" rel="stylesheet"/> -->
<link href="<?php echo $baseUrl; ?>/js/Push-Notification/lib/css/messenger.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/Push-Notification/lib/js/messenger.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/Push-Notification/lib/js/progressbar.min.js"></script>
<?php 
$id=Yii::app()->request->cookies['cookie_user_id']->value;
$str="SELECT
a.surname,
a.nickname,
a.fullname,
a.`name`,
a.depast,
b.personal_image,
b.eng_firstname,
b.eng_lastname,
b.eng_nickname,
b.cur_city,
b.cur_post,
c.rankdescript,
b.personal_startdate,
b.home_land
FROM
msystem.sysuser AS a
INNER JOIN jibhr.personal_profile AS b ON b.personal_id = a.`name`
LEFT JOIN jibhr.og_rank AS c ON c.rankid = b.personal_rank
WHERE
a.`name` = '$id'
LIMIT 1";

$result=Yii::app()->jibhr->createCommand($str)->queryRow();
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->createUrl("site/index"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">User profile</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 <div class="row">
  <!--  -->
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
        <?php if($id==2433){ ?>
        <h3>รายการ job ของพนักงาน</h3>
        <?php }else{ ?>
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
              <div class="widget-user-image">
                <img src="/JIBHR/img_hr/<?php echo $result['personal_image']; ?>" class="img-circle" alt="User Image" style="width: 70px;height: 70px;">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php echo $result['eng_firstname'].' '.$result['eng_lastname'] ?></h3>
              <h5 class="widget-user-desc">JOB DETAILS</h5>
            </div>
            <?php 
            $perid=Yii::app()->request->cookies['cookie_user_id']->value;
            $y=date('Y');
            $m=date('m');
            $mm= (int)$m;

            $sqljob="SELECT a.personalid, a.score, a.percen_score, a.grade, a.maxjob, a.joboverdue, a.empty_day,a.total_grade,a.complete_job, a.jobmonth,a.jobyear,b.fullname, b.surname, b.nickname
            FROM
            es_result AS a
            LEFT JOIN sysuser AS b ON a.personalid = b.`name`
            WHERE a.jobyear='$y' AND a.jobmonth='$mm' AND a.personalid='$id'
            ORDER BY a.percen_score DESC";
            //echo $sqljob;
            $resjob=Yii::app()->msystem->createCommand($sqljob)->queryRow();

            ?>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Projects <span class="pull-right badge bg-blue"><?php echo $resjob['maxjob']; ?></span></a></li>
                <li><a href="#">Tasks <span class="pull-right badge bg-yellow">
                  <?php $t_job = ($resjob['maxjob']-$resjob['complete_job']); 
                  echo $t_job;
                  ?>

                </span></a></li>
                <li><a href="#">Completed Projects <span class="pull-right badge bg-green"><?php echo $resjob['complete_job']; ?></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>

        <div class="col-md-4 col-lg-4 col-xs-8">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php 

              echo $resjob['score'];

              ?></h3>
              

              <p>คะแนน</p>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-pie-chart"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-md-4 col-lg-4 col-xs-8">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo number_format($resjob['percen_score']); ?><sup style="font-size: 20px">%</sup></h3>

              <p>เปอร์เซ็น</p>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-pie-chart"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-md-4 col-lg-4 col-xs-8">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php if($resjob['grade']==''){
                echo "-";
              }else{
                echo $resjob['grade'];
              } ?></h3>

              <p>เกรด</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-md-4 col-lg-4 col-xs-8">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php if($resjob['total_grade']==''){
                echo "-";
              }else{
                echo $resjob['total_grade'];
              } ?></h3>

              <p>เกรดรวม</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <?php } ?>
      </div>

    </div>

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Job List</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <form method="get" accept-charset="utf-8" class="form-search">

            <div class="col-md-2">
              <?php echo CHtml::dropDownList("status", ($status) ? $status : null , array(0=> 'In Process', 1=> 'Send', 2=> 'checking', 3=> 'Success'), array("class" => "form-control")); ?>
            </div>
            <div class="col-md-1">
              <button type="submit" class="btn btn-info pull-right">ค้นหา</button>
            </div>
          </form>
        </div>
        <?php $sql="SELECT * FROM
        (SELECT a.id,a.level,a.title,c.program_name,b.level_name,a.startdate,a.enddate,a.contact AS conid,a.url,a.detail,a.`status` AS st,
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
      ) AS t";
      if($id==2433 or $id==8844){
        if(!empty($_GET['status'])){
          $sql.=" WHERE st='".$_GET['status']."' ";
        }else{
          $sql.=" WHERE st=0 ";
        }
      }else{
        $sql.=" WHERE conid='$id'";
        if(!empty($_GET['status'])){
          $sql.=" AND st='".$_GET['status']."' ";
        }else{
          $sql.=" AND st=0";
        }

      }

   /* $sql.=") AS t ";
    if(!empty($_POST['status'])){
        $sql.=" AND st='".$_POST['status']."' ";
      }*/

      $sql.=" ORDER BY id DESC";
    //echo $sql;
      $res=Yii::app()->msystem->createCommand($sql)->queryAll();
      $jnum=count($res);
      ?>
      <table id="example2" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>ลบ</th>
            <th>แก้ไข</th>
            <th>ดู</th>
            <th>Descriptions</th>
            <th>Dereloper</th>
            <th>Referent</th>
            <th>Level</th>
            <th>Status</th>
            <th>Start</th>
            <th>End</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($res as $key => $r) { ?>
          <tr>
            <td class="text-center">
              <?php if($r['conid']==$id or $id==2433) {?>
              <button class="btn btn-danger btn-xs" id="del"><i class="fa fa-fw fa-times-circle"></i></button>
              <input type="hidden" name="jobid" id="jobid" value="<?php echo $r['id']; ?>">
              <?php }else{ ?> 
              <button class="btn btn-danger btn-xs" disabled><i class="fa fa-fw fa-times-circle"></i></button>
              <?php } ?>
            </td>
            <td class="text-center">
              <a class="btn btn-warning btn-xs" href="<?php echo $this->createUrl("createjob/index",array("id"=>$r['id'])); ?>"><i class="fa fa-edit"></i></a>
            </td>
            <td class="text-center">

              <a class="btn btn-info btn-xs" onclick="PopupCenterDual('<?php echo $this->createUrl("createjob/popup", array("id" => $r['id'])); ?>','NIGRAPHIC','900','500'); " href="javascript:void(0);"><i class="fa fa-fw fa-sticky-note"></i></a>
            </td>
            <td><?php echo $r['title']; ?></td>
            <td><?php echo $r['personal_name']; ?></td>
            <td><?php echo $r['program_name']; ?></td>
            <td><?php echo $r['level_name']; ?></td>
            <td><?php echo $r['status']; ?></td>
            <td><?php echo MyClass::convertDate($r['startdate']); ?></td>
            <td><?php echo MyClass::convertDate($r['enddate']); ?></td>
          </tr>
          <?php  } ?>
        </tbody>

      </table>
    </div>
  </div>
</div>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">View Job Descriptions</h4>
        </div>
        <div class="modal-body">
          <p>One fine body&hellip;</p><div id="value"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left">แก้ไข</button>
          <button type="button" class="btn btn-primary">ส่งงาน</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

</section>
<!-- /.content -->



<script>
 
  $(document).ready(function(){
    var job = "<?php echo $jnum; ?>";
   var messenger = new Messenger();
    messenger.run({

  // unique ID
  'id':'001',

  // unique name
  'name':'alpha',

  // alert title
  'title':'Message',

  // alert message
  'message':'คุณมีรายการ JOB ค้างอยู่  '+ job +' รายการ', // content

  // duration of timer
  'duration':5000, 

  // theme name
  'theme':'light', 

  // font awesome icon fa-{value}
  'icon':'bolt', 

  // top-right | bottom-right | bottom-left | top-left
  'location':'top-right'
  
});
    // var job = "<?php echo $jnum; ?>";
    // showNotification({
    //   message: "คุณมีรายการ JOB ค้างอยู่  "+ job +" รายการ",
    //   type: "success",
    //   autoClose: true,
    //   duration: 5
    // });
  });

  $(function () {
    $("#del").click(function(){
      swal({
        title: "ต้องการลบ job นี้ใช่หรือไม่?",
        text: "คุณจะไม่สามารถกู้คืนได้!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      },
      function(){
       var id=$("#jobid").val();
       $.post("<?php echo $this->createUrl("site/jobdel"); ?>", {id:id})
       .done(function( data,status ) {
         if(data=='Message sent!'){
          swal("Deleted!", "Your job has been deleted.", "success");
          location.reload();
        }
      });
       //swal("Deleted!", "Your imaginary file has been deleted.", "success");
     });
    });
  });
  function PopupCenterDual(url, title, w, h) {
    // Fixes dual-screen position Most browsers Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
      newWindow.focus();
    }
  }

  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>