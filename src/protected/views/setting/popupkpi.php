<?php $baseUrl=Yii::app()->request->baseUrl; ?>
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
	<br>
	<div class="container">
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th style="width: 100px">รหัสพนักงาน</th>
							<th class="text-center" >ชื่อ - นามสกุล</th>
							<th style="width: 130px" class="text-center" >เพิ่ม-ลบ-แก้ไข</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($user as $key => $r) { ?>
							<tr>
								<td><?php echo $r["personal_id"] ?></td>
								<td><?php echo $r["titlename"] . " " . $r["personal_name"] . " " . $r["personal_lastname"]; ?></td>
								<td><div align="center"><a class="btn btn-default btn-xs" href="<?php echo $this->createUrl("setting/popupkpiview", array("id" => $r["personal_id"])); ?>"><i class="glyphicon glyphicon-user"></i></a></div></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</body>
	</html>