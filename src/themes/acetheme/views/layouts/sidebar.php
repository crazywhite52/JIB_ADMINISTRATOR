<?php $baseUrl = Yii::app()->request->baseUrl; 
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
b.cur_post 
FROM 
msystem.sysuser AS a INNER JOIN personal_profile b ON b.personal_id=a.`name` 
WHERE 
a.`name` = '$id' LIMIT 1";

$result=Yii::app()->jibhr->createCommand($str)->queryRow();

?>
<!-- =============================================== -->
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <?php if($result['personal_image'] != '' || $result['personal_image'] != null){ ?>
          <img src="/JIBHR/img_hr/<?php echo $result['personal_image']; ?>" class="img-circle" alt="User Image">
        <?php }else{ ?>
          <img src="<?php echo $baseUrl; ?>/adminLTE/dist/img/avatar5.png" class="img-circle" alt="User Image">
        <?php } ?>
      </div>
      <div class="pull-left info">
        <p><?php echo Yii::app()->request->cookies['cookie_user_nickname']->value; ?></p>
        <a href="<?php echo $this->createUrl("site/index"); ?>"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <?php 
    $contro=Yii::app()->controller->id;
    $active1=null;$active=null;
    $active2=null;$active3=null;$active4=null;$active5=null;$active6=null;$active7=null;$active8=null;$active9=null;$active10=null;
    if($contro=='disstock'){
      $active1='active';
      $active='active';
    }if($contro=='reportkrajai'){
      $active2='active';
      $active='active';
    }if($contro=='miskpi'){
      $active3='active';
    }if($contro=='manageuser'){
      $active4='active';
    }if($contro=='mprogram'){
      $active5='active';
    }if($contro=='helpdesk'){
      $active6='active';
    }if($contro=='createjob'){
      $active7='active';
    }if($contro=='site'){
      $active8='active';
    }if($contro=='setting'){
      $active9='active';
    }if($contro=='reprint'){
      $active10='active';
    }
    ?>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN MENU</li>
      <li class="<?php echo $active3; ?>"><a href="<?php echo $this->createUrl("miskpi/index"); ?>"><i class="fa fa-dashboard"></i> <span>Status คะแนนพนักงาน</span></a></li>
      <li class="<?php echo $active7; ?>"><a href="<?php echo $this->createUrl("createjob/index"); ?>" "><i class="fa fa-fw fa-pencil-square-o"></i> <span>Create Job</span></a></li>
      <li class="<?php echo $active8; ?>"><a href="<?php echo $this->createUrl("site/index"); ?>" "><i class="fa fa-fw fa-reorder"></i> <span>รายการjob</span></a></li>

      <li class="<?php echo $active4; ?>"><a href="<?php echo $this->createUrl("manageuser/index"); ?>"><i class="fa fa-fw fa-user-plus"></i> <span>Manager User</span></a></li>
      <li class="<?php echo $active5; ?>"><a href="<?php echo $this->createUrl("mprogram/index"); ?>"><i class="fa fa-fw fa-file-text"></i> <span>Manager Program</span></a></li>
      <li class="<?php echo $active9; ?>"><a href="<?php echo $this->createUrl("setting/index"); ?>"><i class="fa fa-fw fa-database"></i> <span>Setting KPI</span></a></li>
      <li class="treeview <?php echo $active; ?>">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Utility For Admin</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php echo $active1; ?>"><a href="<?php echo $this->createUrl("disstock/index"); ?>"><i class="fa fa-circle-o"></i> ล้างกระจาย Br.6 || Br.21</a></li>
          <li class="<?php echo $active2; ?>"><a href="<?php echo $this->createUrl("reportkrajai/index"); ?>"><i class="fa fa-circle-o"></i> รายงานการกระจาย</a></li>
          <li class="<?php echo $active10; ?>"><a href="<?php echo $this->createUrl("reprint/index"); ?>"><i class="fa fa-circle-o"></i> รีปลิ้นเอกสาร Requert</a></li>
        </ul>
      </li>
      <li class="<?php echo $active6; ?>"><a href="<?php echo $this->createUrl("helpdesk/index"); ?>"><i class="fa fa-fw fa-plus-square"></i> <span>Help Desk</span></a></li>
      <!-- <li><a href=""><i class="fa fa-book"></i> <span>ปริ้นสเปคสินค้า</span></a></li> -->
        <!-- <li class="header">ABOUT</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script>
    $(document).ready(function () {
      $('.sidebar-menu').tree()
    })
  </script>