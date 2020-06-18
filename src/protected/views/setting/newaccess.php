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

</body>
</html>