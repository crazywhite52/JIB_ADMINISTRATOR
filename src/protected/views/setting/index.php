<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<link href="<?php echo $baseUrl; ?>/js/Push-Notification/lib/css/messenger.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/Push-Notification/lib/js/messenger.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/Push-Notification/lib/js/progressbar.min.js"></script>
<section class="content-header">
	<h1>
		Setting KPI
		<small>ตั้งค่าสิทธิ์ Admin</small>
	</h1>

</section>
<section class="content"> 
	

	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="btn info-box-icon bg-aqua" data-toggle="modal" data-target="#modal-default"><i class="fa fa-fw fa-bar-chart-o"></i></span>

				<div class="info-box-content">
					<span class="info-box-text"></span>
					<span class="info-box-number">ตาราง ระดับคะแนน</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="btn info-box-icon bg-yellow" onclick="PopupCenterDual('<?php echo $this->createUrl("setting/popupkpi"); ?>','NIGRAPHIC','900','500'); "><i class="fa fa-fw fa-bar-chart-o"></i></span>

				<div class="info-box-content">
					<span class="info-box-text"></span>
					<span class="info-box-number">ตาราง กำหนดสิทธิ์ JOB KPI</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="btn info-box-icon bg-green" data-toggle="modal" data-target="#modal-default2"><i class="fa fa-fw fa-bar-chart-o"></i></span>

				<div class="info-box-content">
					<span class="info-box-text"></span>
					<span class="info-box-number">ตาราง สิทธิ์ข้อมูลพนักงาน</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="btn info-box-icon bg-red" onclick="PopupCenterDual('<?php echo $this->createUrl("setting/settingpopup"); ?>','NIGRAPHIC','900','500'); "><i class="fa fa-fw fa-bar-chart-o"></i></span>

				<div class="info-box-content">
					<span class="info-box-text"></span>
					<span class="info-box-number">ตาราง ตั้งค่าสิทธิ์</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
	</div>
</section>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">ระดับคะแนน</h4>
				</div>
				<form action="<?php echo $this->createUrl("Setting/Save"); ?>" method="post" accept-charset="utf-8">
					<div class="modal-body">
						<?php $level = EsLevels::model()->findAll(); ?>
						<table class="table table-bordered">
							<tr>
								<th style="width: 50px">ID</th>
								<th>Degree</th>
								<th style="width: 100px">Score</th>

							</tr>
							<?php foreach ($level as $key => $r) { ?>
								<tr>
									<td><input type="hidden" name="id[]" value="<?php echo $r["id"] ?>"><?php echo $r["id"] ?></td>
									<td><input class="form-control input-sm" type="text" name="level_name[]" id="level_name" value="<?php echo $r["level_name"] ?>" ></td>
									<td><input class="form-control input-sm" type="text" name="score[]" id="score" value="<?php echo $r["score"] ?>" ></td>

								</tr>
								<?php } ?>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<div class="modal fade" id="modal-default2">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">ตาราง สิทธิ์ข้อมูลพนักงาน</h4>
						</div>
						<div class="modal-body"> 
							<?php
							$q = "SELECT * FROM personal_profile a LEFT JOIN personal_title b ON a.personal_title=b.titleid WHERE personal_id = '".Yii::app()->request->cookies['cookie_user_id']->value."' ";
							$rs = Yii::app()->jibhr->createCommand($q)->queryRow();
							?>
							<?php $access = EsAccess::model()->findAll(); ?>
							<table class="table table-bordered">
								<tr>
									<th style="width: 50px">สิทธิ์</th>
									<th style="width: 50px">ID</th>
									<th>Title</th>
									<th style="width: 70px">สร้าง</th>
									<th style="width: 70px">อ่าน</th>
									<th style="width: 70px">แก้ไข</th>
									<th style="width: 70px">ลบ</th>

								</tr>
								<?php foreach ($access as $key => $r) { 
									$q1 = "SELECT * FROM es_user WHERE personalid='" . $rs["personal_id"] . "' AND access='" . $r["id"] . "'";
									$rs1 = Yii::app()->msystem->createCommand($q1)->queryRow();
									if (!empty($rs1)) {
										$chk = "checked";
									} else {
										$chk = "";
									}
									?>
									<tr>
										<td><input type="checkbox" name="" <?php echo $chk ?> disabled></td>
										<td><?php echo $key+1; ?></td>
										<td><?php echo $r["detail"] ?></td>
										<td><div align="center">
											<?php
											if ($r["creates"] == 1) {
												echo '<i class="fa fa-fw fa-check-square"></i>';
											}
											?>
										</div></td>
										<td><div align="center">
											<?php
											if ($r["reads"] == 1) {
												echo '<i class="fa fa-fw fa-check-square"></i>';
											}
											?>
										</div></td>
										<td><div align="center">
											<?php
											if ($r["updates"] == 1) {
												echo '<i class="fa fa-fw fa-check-square"></i>';
											}
											?>
										</div></td>
										<td><div align="center">
											<?php
											if ($r["deletes"] == 1) {
												echo '<i class="fa fa-fw fa-check-square"></i>';
											}
											?>
										</div></td>
									</tr>
									<?php } ?>
								</table>
							</div>
							<div class="modal-footer">

							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<script>
					$(document).ready(function(){
						var job = "<?php echo $msg; ?>";
						if(job!=1){
							var txt="บันทึกข้อมูลเรียบร้อยแล้ว";
							var messenger = new Messenger();
							messenger.run({
  // unique ID
  'id':'001',
  // unique name
  'name':'alpha',
  // alert title
  'title':'Message',
  // alert message
  'message': txt , // content
  // duration of timer
  'duration':2000, 
  // theme name
  'theme':'light', 
  // font awesome icon fa-{value}
  'icon':'bolt', 
  // top-right | bottom-right | bottom-left | top-left
  'location':'top-right'
});

						}else{

						}

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
</script>