<?php

class SettingController extends CController
{
	public function actionIndex($msg=1)
	{
		if (empty(Yii::app()->request->cookies['cookie_user_no']->value)) {
			$this->redirect(array("Login/in"));
		}

		$this->render("index",array('msg'=>$msg));
	}
	public function actionNewaccess($id = null)
	{
		$access = new EsAccess();
		if (!empty($_POST)) {
			$id = $_POST["EsAccess"]["id"];

			if (!empty($id)) {
				$access = EsAccess::model()->findByPk($id);
			}

			$access->_attributes = $_POST["EsAccess"];
			if($access->save()){
				echo "<script>window.location.href='" . $this->createUrl('setting/settingpopup') . "';</script>";
			}
		}
		if (!empty($id)) {
			$access = EsAccess::model()->findByPk($id);
		}

		$this->renderPartial("newaccess", array(
			"access" => $access
		));
	}
	public function actionPopupKPI()
	{
		$q = "SELECT a.personal_id,a.personal_name,a.personal_lastname,b.titlename FROM personal_profile a LEFT JOIN personal_title b ON a.personal_title=b.titleid WHERE a.personal_line='3' AND a.status='0' ORDER BY CAST(a.personal_id AS SIGNED) ASC";
		$user = Yii::app()->jibhr->createCommand($q)->queryAll();

		if(!empty($_POST)){
			$id = $_POST['id'];
			$access = $_POST['access'];
			$delete = "DELETE FROM es_user WHERE personalid='$id'";
			Yii::app()->msystem->createCommand($delete)->execute();
			foreach ($access as $r) {
				$insert = "INSERT INTO es_user(personalid,access) VALUES('$id','$r')";
				Yii::app()->msystem->createCommand($insert)->execute();
			}
		}

		$this->renderPartial("popupkpi",array("user"=>$user));
	}
	public function actionPopupKPIview()
	{
		$this->renderPartial("popupkpiview");
	}
	public function actionSettingPopup()
	{
		$access = new EsAccess();
		if (!empty($_POST)) {
			$access->_attributes = $_POST["EsAccess"];
			if($access->save()){
				echo "<script>window.location.href='" . $this->createUrl('setting/settingpopup') . "';</script>";
			}
		}
		$this->renderPartial("settingpopup", array(
			"access" => $access
		));
	}
	public function actionDeleteAccess($id = null) {
		EsAccess::model()->deleteByPk($id);
		$this->redirect(array("settingpopup"));
	}
	public function actionSave()
	{
		$msg=null;
		if(!empty($_POST)){

			$chk = $_POST["id"];
			$level_name=$_POST['level_name'];
			$score=$_POST['score'];

			foreach($chk as $key => $n ) {
				$int = "UPDATE es_levels SET 
				level_name='".$level_name[$key]."',
				score='".$score[$key]."'
				WHERE id='$n' ";
				$result=Yii::app()->msystem->createCommand($int)->execute();
				//echo $int.'<br>';

			}
			$msg=2;
			echo "<script>window.location.href='" . $this->createUrl('Setting/Index',array('msg'=>$msg)) . "'</script>";

			// $id=$_POST['id'];
			// $level_name=$_POST['level_name'];
			// $score=$_POST['score'];
			// $int = "UPDATE es_levels SET level_name='".$level_name."',score='$score'
			// WHERE id='$id' ";
			// echo $int;
		}
	}

	
}
?>