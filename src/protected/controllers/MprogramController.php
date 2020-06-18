<?php 

class MprogramController extends CController
{
    public function actionIndex($id = null)
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
            $str = "SELECT * FROM sysprogram WHERE id=$id ";
            $data = Yii::app()->msystem->createCommand($str)->queryRow();
        }
        $this->render("index",array(
            "id"=>$id,
            "data"=>$data
        ));
    }
    public function actionDataprogram()
    {
        if(!empty($_POST["id"])){
            $id=$_POST["id"];
            $sql = "UPDATE sysprogram SET
                            program_name='".$_POST['program_name']."',
                            program_text='".$_POST['program_text']."',
                            program_user='".$_POST['program_user']."'
                            WHERE id=$id ";
            Yii::app()->msystem->createCommand($sql)->execute();
            $msg = 'Update Success';
            echo "<script type=\"text/javascript\">window.alert('Update Success');
            window.location.href = window.location.href = '" . $this->createUrl("mprogram/index") . "'</script>"; 
            exit;
        }else{
            $sql = "INSERT INTO sysprogram ( program_name, program_text, program_user)
            VALUES ('".$_POST['program_name']."', '".$_POST['program_text']."', '".$_POST['program_user']."')";
            Yii::app()->msystem->createCommand($sql)->execute();
            echo "<script type=\"text/javascript\">window.alert('Save is success');
            window.location.href = window.location.href = '" . $this->createUrl("mprogram/index") . "'</script>"; 
            exit;
            
        }
    }
    public function actionProdate()
    {
        $str="SELECT t.* FROM(SELECT a.id,a.program_name, a.program_text, 
        CASE
            WHEN a.program_user = 0 THEN 'ไม่ได้ใช้งาน'
            WHEN a.program_user = 1 THEN 'ใช้งาน'
        END AS program_user 
        FROM sysprogram AS a ";
        $where = " WHERE ";
        if (!empty($_GET["program_name"])) {
            $str.=$where." (a.program_name LIKE '%" . $_GET["program_name"] . "%') ";
            $where = " AND ";
        }
        $str.=") AS t ";


        // $str = $str." LIMIT $start, $pagesize";
        $result=Yii::app()->msystem->createCommand($str)->queryAll();


        foreach ($result as $r) {
            $data[]=array(
                'id' => $r['id'],
                'program_name' => $r['program_name'],
                'program_text' => $r['program_text'],
                'program_user' => $r['program_user']
            );
        }

        echo json_encode($data);
    }
    public function actionDeletelist() {
        if (!empty($_POST["id"])) {
            $id = $_POST["id"];
            $sql = "DELETE FROM sysprogram WHERE id='$id' ";
            echo Yii::app()->msystem->createCommand($sql)->execute();            
        }
    }
    public function actionMenulist($id=null,$menu_id=null)
    {
        $data = null;
        if(!empty($menu_id)){
            $str = "SELECT * FROM sysmenu WHERE menu_id = $menu_id AND program_id=$id";
            $data = Yii::app()->msystem->createCommand($str)->queryRow();
        }

        $this->render("menulist",array('id'=>$id,'data'=>$data,'menu_id'=>$menu_id));
    }
    public function actionMenudatabase()
    {
        $id=$_GET['id'];

        $str="SELECT t.* FROM (SELECT a.menu_id,b.id,a.program_id,a.menu_name,
            CASE
                WHEN a.menu_cancel = 0 THEN 'ไม่ได้ใช้งาน'
                WHEN a.menu_cancel = 1 THEN 'ใช้งาน'
            END AS menu_cancel 
            FROM sysmenu AS a INNER JOIN sysprogram b ON a.program_id = b.id  
            WHERE a.program_id = ' $id' ORDER BY a.menu_id  ASC"; 
        $where = " AND ";

        if (!empty($_GET["menu_name"])) {
            $str.=$where." (a.menu_name LIKE '%" . $_GET["menu_name"] . "%') ";
            $where = " AND ";
        }
        $str.=") AS t ";

        $result=Yii::app()->msystem->createCommand($str)->queryAll();
        foreach ($result as $r) {
            $data[]=array(
                'menu_id' => $r['menu_id'],
                'program_id' => $r['program_id'],
                'menu_name' => $r['menu_name'],
                'menu_cancel' => $r['menu_cancel']
            );
        }
        echo json_encode($data);
    }

    public function actionDatamenu()
    {
        if(!empty($_POST["menu_id"])){
            $menu_id=$_POST["menu_id"];
            $sql = "UPDATE sysmenu SET
                menu_name='".$_POST['menu_name']."',
                menu_cancel='".$_POST['menu_cancel']."'
                WHERE menu_id='$menu_id' AND program_id='".$_POST['program_id']."'";
            Yii::app()->msystem->createCommand($sql)->execute();

            echo "<script type=\"text/javascript\">window.alert('Save is success');
            window.location.href = window.location.href = '" . $this->createUrl("mprogram/menulist",array('id'=>$_POST['program_id'])) . "'</script>"; 
            exit;
        }else{
           
            $rqmax = "SELECT MAX(menu_id) AS maxid FROM sysmenu where program_id=".$_POST['program_id'];
            $rmax=Yii::app()->msystem->createCommand($rqmax)->queryAll();
            $newid= $rmax[0]['maxid']+1;
            $sql = "INSERT INTO sysmenu (menu_id, program_id, menu_name, menu_cancel)
            VALUES ('$newid','".$_POST['program_id']."', '".$_POST['menu_name']."', '".$_POST['menu_cancel']."')";
            Yii::app()->msystem->createCommand($sql)->execute();

            echo "<script type=\"text/javascript\">window.alert('Save is success');
            window.location.href = window.location.href = '" . $this->createUrl("mprogram/menulist",array('id'=>$_POST['program_id'])) . "'</script>"; 
            exit;
        }
    }
    public function actionDeletemenu() {
        $menu_id=$_POST['menu_id'];
        $program_id=$_POST['program_id'];
        $sql = "DELETE FROM sysmenu WHERE menu_id='$menu_id'AND program_id='$program_id' ";
        echo Yii::app()->msystem->createCommand($sql)->execute();
    }
	
}
 ?>