<?php 

class HelpdeskController extends CController
{
    public function actionIndex()
    {
        $this->render("index");
    }

    public function actionAdd()
	{
		if (!empty($_POST)) {
			$t1=$_POST["table1"];
			$t2=$_POST["editor3"];

			$sql = "INSERT INTO query_detail SET date=NOW(),title='$t1',detail='$t2'";
			Yii::app()->msystem->createCommand($sql)->execute();
			echo "<script>alert('บันทึกสำเร็จ');window.location.href = '" . $this->createUrl('Helpdesk/index') . "'</script>";

		}
		$this->render('createquery');

	}

	public function actionQuerylist()
	{
		
		$str="SELECT
		query_detail.date,
		query_detail.title,
		query_detail.detail,
		query_detail.id,
		query_detail.upd
		FROM 
		query_detail  order by query_detail.date DESC 
		";


		$result=Yii::app()->msystem->createCommand($str)->queryAll();
		$data=array();
		foreach ($result as $r ) {

			$data[]=array(
				'date'=>$r['date'],
				'title'=>$r['title'],
				'detail'=>$r['detail'],
				'id'=>$r['id'],
				'upd'=>$r['upd']
				
			);
			
		}
		echo json_encode($data);
	}

	
	public function actionDelete()
    {
    	$id=$_POST['id'];
    $author = Yii::app()->request->cookies['cookie_user_id']->value;
    	echo Yii::app()->msystem->createCommand("DELETE FROM query_detail WHERE id='$id' ")->execute();

 
    }
}
 ?>