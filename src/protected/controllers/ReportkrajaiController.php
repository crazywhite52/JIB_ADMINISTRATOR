<?php 
class ReportkrajaiController extends CController
{
    public function actionIndex()
    {
        $this->render("index");
    }
    public function actionShowlog(){
		$date_befor=MyClass::insertDate($_GET['date_befor']);
		$date_after=MyClass::insertDate($_GET['date_after']);


		$str="SELECT CONCAT('[',userid,'] ',p1.personal_name,' ',p1.personal_lastname,', ',p1.personal_nickname) AS userid,
dist_log.starttime,
dist_log.endtime,
dist_log.result,
dist_log.upd
FROM
dist_log
INNER JOIN jibhr.personal_profile p1 ON TRIM(p1.personal_id) = TRIM(userid)
WHERE DATE(dist_log.upd) BETWEEN '$date_befor' AND '$date_after' ORDER BY dist_log.upd DESC";


		$result=Yii::app()->db->createCommand($str)->queryAll();
		$data=array();
		foreach ($result as $r ) {

			$data[]=array(
				'userid'=>$r['userid'],
				'starttime'=>$r['starttime'],
				'endtime'=>$r['endtime'],
				'result'=>$r['result'],	
				'upd'=>$r['upd']
				);
			
		}
		echo json_encode($data);

	}
	
}
 ?>