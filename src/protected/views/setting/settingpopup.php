<?php $baseUrl=Yii::app()->request->baseUrl; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ตาราง ตั้งค่าสิทธิ์</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<br>
	<div class="container">

		<div class="row">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">ADD NEW!</button>
			<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">สร้าง</h4>
						</div>
						<?php $form = $this->beginWidget('CActiveForm', array()); ?>
						<div class="modal-body">
							<div class="form-group">
								<?php echo $form->labelEx($access, "detail",array("class"=>"control-label")); ?>
								<?php echo $form->textField($access, "detail",array("class"=>"form-control input-sm")); ?>
							</div>

							<div class="checkbox">
								<label>
									<?php echo $form->checkbox($access, "creates"); ?>
									<?php echo $form->labelEx($access, "creates"); ?>
								</label>
							</div>
							<div class="checkbox">
								<label>
									<?php echo $form->checkbox($access, "reads"); ?>
									<?php echo $form->labelEx($access, "reads"); ?>
								</label>
							</div>
							<div class="checkbox">
								<label>
									<?php echo $form->checkbox($access, "updates"); ?>
									<?php echo $form->labelEx($access, "updates"); ?>
								</label>
							</div>
							<div class="checkbox">
								<label>
									<?php echo $form->checkbox($access, "deletes"); ?>
									<?php echo $form->labelEx($access, "deletes"); ?>
								</label>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
						<?php echo $form->hiddenField($access, "id") ?>
						<?php $this->endWidget(); ?>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th style="width: 50px">No.</th>
							<th class="text-center">Title</th>
							<th class="text-center" style="width: 100px">สร้าง</th>
							<th class="text-center" style="width: 100px">อ่าน</th>
							<th class="text-center" style="width: 100px">แก้ไข</th>
							<th class="text-center" style="width: 100px">ลบ</th>
							<th class="text-center" style="width: 100px">UPDATE</th>
							<th class="text-center" style="width: 100px">DEL</th>
						</tr>
					</thead>
					<?php $access = EsAccess::model()->findAll(); ?>
					<tbody>
						<?php foreach ($access as $key => $r) { ?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $r["detail"]; ?></td>
								<td><div align="center">
									<?php
									if ($r["creates"] == 1) {
										echo '<i class="glyphicon glyphicon-ok-circle"></i>';
									}
									?>
								</div></td>
								<td><div align="center">
									<?php
									if ($r["reads"] == 1) {
										echo '<i class="glyphicon glyphicon-ok-circle"></i>';
									}
									?>
								</div></td>
								<td><div align="center">
									<?php
									if ($r["updates"] == 1) {
										echo '<i class="glyphicon glyphicon-ok-circle"></i>';
									}
									?>
								</div></td>
								<td><div align="center">
									<?php
									if ($r["deletes"] == 1) {
										echo '<i class="glyphicon glyphicon-ok-circle"></i>';
									}
									?>
								</div></td>
								<td><div align="center"><a class="btn btn-default btn-xs" href="<?php echo $this->createUrl("setting/newaccess",array("id"=>$r["id"])); ?>"><i class="glyphicon glyphicon-folder-open"></i></a></div></td>
								<td><div align="center"><a class="btn btn-default btn-xs" href="<?php echo $this->createUrl("setting/deleteAccess", array("id" => $r["id"])); ?>" onClick="return confirm('คุณต้องการลบ ใช่ หรือ ไม่?')"><i class="glyphicon glyphicon-trash"></i></a></div></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</body>
	</html>