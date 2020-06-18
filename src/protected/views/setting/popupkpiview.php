<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<?php
$q = "SELECT * FROM personal_profile a LEFT JOIN personal_title b ON a.personal_title=b.titleid WHERE personal_id = '".$_GET['id']."' ";
$rs = Yii::app()->jibhr->createCommand($q)->queryRow();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ตาราง กำหนดสิทธิ์ JOB KPI</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h3> ตารางสิทธิ์ของ <small><?php echo $rs["personal_id"] . " " . $rs["titlename"] . " " . $rs["personal_name"] . " " . $rs["personal_lastname"] . " " . "," . $rs["personal_nickname"]; ?></small></h3>
		</div>
		<div class="row">
			<div class="table-responsive">
				<form action="<?php echo $this->createUrl("setting/popupkpi"); ?>" method="post">
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					<button style="margin-bottom: 10px;" type="submit" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-save"></i> Save</button>

					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th style="width: 50px"></th>
								<th style="width: 100px">ลำดับ</th>
								<th class="text-center" >Title</th>
								<th style="" class="text-center" >สร้าง</th>
								<th style="" class="text-center" >อ่าน</th>
								<th style="" class="text-center" >แก้ไข</th>
								<th style="" class="text-center" >ลบ</th>
								<!-- <th style="" class="text-center" >แก้ไข</th> -->
							</tr>
						</thead>
						<?php $access = EsAccess::model()->findAll(); ?>
						<tbody>
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
									<td>
										<input value="<?php echo $r["id"]; ?>" type="checkbox" name="access[]" id='access' <?php echo $chk; ?>/>
									</td>
									<td><?php echo $key+1; ?></td>
									<td><?php echo $r["detail"] ?></td>
									<td><div align="center">
										<?php
										if ($r["creates"] == 1) {
											echo '<i class="glyphicon glyphicon-ok-circle"></i>';
										}
										?>
									</div>
								</td>
								<td>
									<div align="center">
										<?php
										if ($r["reads"] == 1) {
											echo '<i class="glyphicon glyphicon-ok-circle"></i>';
										}
										?>
									</div>
								</td>
								<td>
									<div align="center">
										<?php
										if ($r["updates"] == 1) {
											echo '<i class="glyphicon glyphicon-ok-circle"></i>';
										}
										?>
									</div>
								</td>
								<td>
									<div align="center">
										<?php
										if ($r["deletes"] == 1) {
											echo '<i class="glyphicon glyphicon-ok-circle"></i>';
										}
										?>
									</div>
								</td>
								<!-- <td><div align="center"><a class="btn btn-default btn-xs" href="<?php echo $this->createUrl("setting/newaccess",array("id"=>$r["id"])); ?>"><i class="glyphicon glyphicon-folder-open"></i></a></div></td> -->
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>

</body>
</html>