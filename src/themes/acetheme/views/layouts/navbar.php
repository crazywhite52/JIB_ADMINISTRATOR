<?php
$baseUrl=Yii::app()->request->baseUrl; 
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
b.personal_startdate
FROM
msystem.sysuser AS a
INNER JOIN jibhr.personal_profile AS b ON b.personal_id = a.`name`
LEFT JOIN jibhr.og_rank AS c ON c.rankid = b.personal_rank
WHERE
a.`name` = '$id'
LIMIT 1";

$result=Yii::app()->jibhr->createCommand($str)->queryRow();
?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $this->createUrl("site/index"); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Ad</b>m</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>istrator</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
 
          <li class="dropdown user user-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo Yii::app()->request->cookies['cookie_user_prosonal']->value; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if($result['personal_image'] != '' || $result['personal_image'] != null){ ?>
                <img src="/JIBHR/img_hr/<?php echo $result['personal_image']; ?>" class="img-circle" alt="User Image">
                <?php }else{ ?>
                 <img src="<?php echo $baseUrl;?>/adminLTE/dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
               <?php } ?>
                <p>
                  <?php echo Yii::app()->request->cookies['cookie_user_prosonal']->value; ?> - <?php echo $result['rankdescript']; ?>
                  <small>Member since <?php echo $result['personal_startdate']; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
             <!--  <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                
              </li>  -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo $this->createUrl("site/index"); ?>" class="btn btn-default btn-flat">Profile</a>
                   
                </div>
                <div class="pull-right">
                  <a href="<?php echo $this->createUrl("login/out"); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>