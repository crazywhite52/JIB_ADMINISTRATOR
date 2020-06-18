<?php 

class CreatejobController extends CController
{
    public function actionIndex($id=null)
    {
    	if (empty(Yii::app()->request->cookies['cookie_user_no']->value)) {
            $this->redirect(array("Login/in"));
        }if (empty(Yii::app()->request->cookies['cookie_user_prosonal']->value)) {
            $this->redirect(array("Login/in"));
        }if (empty(Yii::app()->request->cookies['cookie_user_id']->value)) {
            $this->redirect(array("Login/in"));
        }
    	$data = null;
		 
		if(!empty($id)){
			$str = "SELECT * FROM es_title WHERE id=$id ";
			$data = Yii::app()->msystem->createCommand($str)->queryRow();
		}
        $this->render("index",array(
			"id" => $id,
			"data" => $data   
		));
    }
    public function actionPopup()
    {
    	$this->renderPartial("popup");
    }
	public function actionDatasave()
	{
		if(!empty($_POST["save"])){
			$title=$_POST['title'];
			$startdate=$_POST['startdate'];
			$enddate=$_POST['enddate'];
			$level=$_POST['level'];
			$url=$_POST['url'];
			$personal_id=$_POST['personal_id'];
			$project=$_POST['project'];
			$editor1=base64_encode($_POST['editor1']);
			$id = $_POST["id_hd"];
			if($id!=""){
				$str = "UPDATE es_title SET
					 title='" . $_POST['title'] . "',
					 startdate='" . MyClass::insertDate($_POST['startdate']) . "',
					 enddate='" . MyClass::insertDate($_POST['enddate']) . "',
					 level='" . $_POST['level'] . "',
					 url='" . $_POST['url'] . "',
					 contact='" . $personal_id . "',
					 project='" . $_POST['project'] . "',
					 detail='" . $editor1 . "'
					 WHERE id=$id ";
					 Yii::app()->msystem->createCommand($str)->execute();
					 //echo $str;
					 echo "Message sent!";
			}else{
				$sql = "INSERT INTO es_title ( title, startdate, enddate, level, url, contact, project, detail)
		  VALUES ('$title','".MyClass::insertDate($startdate)."','".MyClass::insertDate($enddate)."','$level','$url','$personal_id','$project','$editor1')";
		  Yii::app()->msystem->createCommand($sql)->execute();

		  	$per_id=Yii::app()->request->cookies['cookie_user_id']->value;
		 
		  	$q = "SELECT * FROM personal_profile a
								LEFT JOIN personal_title b ON a.personal_title=b.titleid
								LEFT JOIN personal_profile_contact c ON a.personal_id=c.personalid
								WHERE a.personal_line='3' AND a.status='0' AND personal_id='$personal_id' ";
					$user = Yii::app()->jibhr->createCommand($q)->queryRow();
			if($per_id==2433){
		  		$m_to=$user['email'];
		  	}else{
		  		$m_to=$user['email'];
		  		$m_to="kritsada.p@jib.co.th";
		  		
		  		//$m_to="Torkait.S@jib.co.th";
		  		//$m_to="kritsada.phanthuwongrach@gmail.com";
		  		//$m_to="torkait.it@gmail.com";
		  	}
		  	$mx="SELECT MAX(id) AS mxid FROM es_title";
		  	$idmax=Yii::app()->msystem->createCommand($mx)->queryRow();
		  	$mid=$idmax['mxid'];
		  	$status = "ตั้งเรื่อง";
		  	$pname=Yii::app()->request->cookies['cookie_user_prosonal']->value;
		  	$work_url = "http://172.18.0.30/admin2018/index.php/site/index";
		  	$to_name			="white";
			$to_email			=$m_to;
			$from_name			="ตั้งจ๊อบงาน จากระบบ Admin2018";
			$email_user_send	="torkait.it2@gmail.com";
			$email_pass_send	="521114982";
			$subject			=$title;
			$body_html			='
<style>
								table, th, td {
									 border: 1px solid black;
									 border-collapse: collapse;
								}
								th, td {
									 padding: 5px;
									 text-align: left;
								}
								</style>
<table width="100%">
								  <tr style="background-color:#FFDEAD;">
								  <th colspan="2"><h2> Descrption : '.$title.'</h2></th>
								  </tr>
								  <tr>
								  <td>สถานะ</td>
								  <td>' . $status . '</td>
								  </tr>
								  
								  <tr>
								  <td>รายละเอียด Job</td>
								  <td>&nbsp;'.$url.'</td>
								  </tr>
								  <tr>
								  <td>ชื่อ - นามสกุล ผู้ทำ</td>
								  <td>&nbsp;'.$pname.'</td>
								  </tr>
								  <tr>
								  <td>&nbsp;Url listjobs</td>
								  <td><a target="_blank" href="' . $work_url. '">' . $work_url. '</a></td>
								  </tr>
						</table>';
			$body_text	="เนื้อหา";

			Sendmail::scriptdd_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text);
			}
		

			//echo 'บันทึกข้อมูลสำเร็จ'; #$title.$startdate.$enddate.$level.$url.$personal_id.$project.$editor1;

	
		}else{
			echo "Error";
		}
	}
	public function actionSendjob()
	{
		if(!empty($_POST)){
			$status=$_POST["status"];
			$id=$_POST["id"];
			$personal_id=$_POST["personal_id"];
			$title=$_POST['title'];
			$url=$_POST['url'];
			if($status==1){
				Yii::app()->msystem->createCommand("UPDATE es_title SET status='$status' ,senddate=NOW() WHERE id='$id'")->execute();
				$q = "SELECT * FROM personal_profile a
								LEFT JOIN personal_title b ON a.personal_title=b.titleid
								LEFT JOIN personal_profile_contact c ON a.personal_id=c.personalid
								WHERE a.personal_line='3' AND a.status='0' AND personal_id='$personal_id' ";
					$user = Yii::app()->jibhr->createCommand($q)->queryRow();
			/*if($per_id==2433){
		  		$m_to=$user['email'];
		  	}else{*/
		  		$m_to="kritsada.p@jib.co.th";
		  		//$m_to="Torkait.S@jib.co.th";
		  		//$m_to="kritsada.phanthuwongrach@gmail.com";
		  		//$m_to="torkait.it@gmail.com";
		  	
		  	$mx="SELECT MAX(id) AS mxid FROM es_title";
		  	$idmax=Yii::app()->msystem->createCommand($mx)->queryRow();
		  	$mid=$idmax['mxid'];
		  	$status = "ส่งงาน";
		  	$pname=Yii::app()->request->cookies['cookie_user_prosonal']->value;
		  	$work_url = "http://172.18.0.30/admin2018/index.php/site/index";
		  	$to_name			="white";
			$to_email			=$m_to;
			$from_name			="ตั้งจ๊อบงาน จากระบบ Admin2018";
			$email_user_send	="torkait.it2@gmail.com";
			$email_pass_send	="521114982";
			$subject			=$title;
			$body_html			='
<style>
								table, th, td {
									 border: 1px solid black;
									 border-collapse: collapse;
								}
								th, td {
									 padding: 5px;
									 text-align: left;
								}
								</style>
<table width="100%">
								  <tr style="background-color:#FFDEAD;">
								  <th colspan="2"><h2> Descrption : '.$title.'</h2></th>
								  </tr>
								  <tr>
								  <td>สถานะ</td>
								  <td>' . $status . '</td>
								  </tr>
								  
								  <tr>
								  <td>รายละเอียด Job</td>
								  <td>&nbsp;'.$url.'</td>
								  </tr>
								  <tr>
								  <td>ชื่อ - นามสกุล ผู้ทำ</td>
								  <td>&nbsp;'.$pname.'</td>
								  </tr>
								  <tr>
								  <td>&nbsp;Url listjobs</td>
								  <td><a target="_blank" href="' . $work_url. '">' . $work_url. '</a></td>
								  </tr>
						</table>';
			$body_text	="เนื้อหา";

			Sendmail::scriptdd_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text);

			}elseif ($status==2) {
				Yii::app()->msystem->createCommand("UPDATE es_title SET status='$status' ,inspectdate=NOW() WHERE id='$id'")->execute();
			echo "Message sent!";
			}elseif ($status==3) {
				Yii::app()->msystem->createCommand("UPDATE es_title SET status='$status' ,testdate=NOW() WHERE id='$id'")->execute();
			echo "Message sent!";
			}elseif ($status==0) {
				 Yii::app()->msystem->createCommand("UPDATE es_title SET status='$status' ,canceldate=NOW() WHERE id='$id'")->execute();
				 echo "Message sent!";
			}else{
			echo "error_sql_save";
			}
			
		}
		
	}
}
 ?>