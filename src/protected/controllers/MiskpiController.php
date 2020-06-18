<?php 

class MiskpiController extends CController
{
    public function actionIndex()
    {
        if (empty(Yii::app()->request->cookies['cookie_user_no']->value)) {
            $this->redirect(array("Login/in"));
        }if (empty(Yii::app()->request->cookies['cookie_user_prosonal']->value)) {
            $this->redirect(array("Login/in"));
        }if (empty(Yii::app()->request->cookies['cookie_user_id']->value)) {
            $this->redirect(array("Login/in"));
        }
        $this->render("index");
    }

	public function actionChartdate(){
			$sql = "SELECT a.grade, a.percen_score, a.jobmonth,a.jobyear,
        CONCAT(trim(b.fullname),' ', trim(b.surname),' ', trim(b.nickname)) as personal_name
        FROM es_result AS a
        INNER JOIN sysuser AS b ON a.personalid = b.`name`";
         $where = " WHERE ";
        if (!empty($_GET["jobmonth"])) {
            $sql.=$where." a.jobmonth = ".$_GET["jobmonth"];
            $where = " AND ";
        }
        if (!empty($_GET["jobyear"])) {
            $sql.=$where." (a.jobyear LIKE '%" . $_GET["jobyear"] . "%') ";
            $where = " AND ";
        }
        $sql.=" ORDER BY percen_score DESC";

		$result=Yii::app()->msystem->createCommand($sql)->queryAll();
        $data=array();
        foreach ($result as $r) {
            $data[]=array(
                'grade' => $r['grade'],
                'percen_score' => number_format($r['percen_score']).'%',
                'personal_name' => $r['personal_name'],
                'MM/YY' => $r['jobmonth'].'/'.$r['jobyear']
            );
        }

        echo json_encode($data);
	}

	public function actionSdate(){
			$sql = "SELECT a.personalid, a.score, a.percen_score, a.grade, a.maxjob, a.joboverdue, a.empty_day,a.total_grade,a.complete_job, a.jobmonth,a.jobyear,b.fullname, b.surname, b.nickname
		FROM es_result AS a
		INNER JOIN sysuser AS b ON a.personalid = b.`name` WHERE a.jobyear='".$_GET["jobyear"]."' ";

        if (!empty($_GET["jobmonth"])) {
            $sql.=" AND a.jobmonth = ".$_GET["jobmonth"];
        }
        /*if (!empty($_GET["jobyear"])) {
            $sql.=$where." (a.jobyear LIKE '%" . $_GET["jobyear"] . "%') ";
            $where = " AND ";
        }*/
        $sql.=" ORDER BY a.percen_score DESC";


		$result=Yii::app()->msystem->createCommand($sql)->queryAll();
        foreach ($result as $r) {
        	$bar = $r['maxjob'] - $r['complete_job'];
        		if ($bar < 0) {
        			$bar=0;
        		}else{
        			$bar;
        		}
            $data[]=array(
                'personalid' => $r['personalid'],
                'score' => number_format($r['score']),
                'percen_score' => $r['percen_score'],
                'grade' => $r['grade'],
                'total_grade' => $r['total_grade'],
                'maxjob' => $r['maxjob'],
                'joboverdue' => $r['joboverdue'],
                'bar' => $bar,
                'empty_day' => $r['empty_day'],
                'complete_job' => $r['complete_job'],
                'personal_name' => '&nbsp;'.$r['fullname'].' '.$r['surname'].','.$r['nickname'],
                'MM/YY' => $r['jobmonth'].'/'.$r['jobyear']
            );
        }

        echo json_encode($data);
	}
}
 ?>