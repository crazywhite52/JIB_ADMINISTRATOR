<?php 

class MuserController extends CController
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
    public function actionMdata()
    {
    	$sql = "SELECT a.system,a.fullname,a.surname,a.nickname,a.`name`,b.branch,b.branchname,a.depast,a.job,a.id,
        CASE
        WHEN a.system =  1 THEN 'admin'
        WHEN a.system = 0 THEN 'user'
        END AS access 
        FROM msystem.sysuser AS a
        LEFT JOIN jib.branch AS b ON a.branch = b.branch";
        $where = " WHERE ";
        if (!empty($_GET["fname"])) {
            $sql.=$where."(a.fullname LIKE '%" . $_GET["fname"] . "%' or a.surname LIKE '%" . $_GET["fname"] . "%' or a.nickname LIKE '%" . $_GET["fname"] . "%')";
            $where = " AND ";
        }
        if (!empty($_GET["branch"])) {
            $sql.=$where."(a.branch='" . $_GET["branch"] . "')";
            $where = " AND ";
        }
        if (!empty($_GET["name_id"])) {
            $sql.=$where."(a.`name` LIKE '%" . $_GET["name_id"] . "%')";
            $where = " AND ";
        }
        if (!empty($_GET["depast"])) {
            $sql.=$where."(a.depast='" . $_GET["depast"] . "')";
            $where = " AND ";
        }
        if (!empty($_GET["job"])) {
            $sql.=$where."(a.job='" . $_GET["job"] . "')";
            $where = " AND ";
        }

        $title = Yii::app()->msystem->createCommand($sql)->queryAll();

        $data=array();
        foreach ($title as $r) {
           $data[]=array(
              'id' => ($r['id']),
              'name' => trim($r['name']),
              'FullName' => trim($r["fullname"]).' '.trim($r["surname"]).','.trim($r["nickname"]),
              'branchname' => trim($r['branchname']),
              'branch' => trim($r['branch']),
              'depast' => trim($r['depast']),
              'job' => trim($r['job']),
              'access_name' => trim($r['access'])
          );
       }
       echo json_encode($data);
   }

   public function actionManageuser($id = null)
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
        $str = "SELECT * FROM sysuser WHERE id=$id ";
        $data = Yii::app()->msystem->createCommand($str)->queryRow();
    }

    $this->render("manageuser",array("id"=>$id,"data"=>$data));
}
public function actionUpdatauser()
{
    if(!empty($_POST["save"]=="true")){
        $id=$_POST["id"];
        $name=$_POST["name"];
        $fullname=$_POST["fullname"];
        $surname=$_POST["surname"];
        $nickname=$_POST["nickname"];
        $depast=$_POST["depast"];
        $job=$_POST["job"];
        $branch=$_POST["branch"];
        $branchname=$_POST["branchname"];
        $password=md5($_POST["password"]);

        if($password==''){
            $sql="UPDATE sysuser SET name='".trim($name)."',fullname='".trim($fullname)."',surname='".trim($surname)."',nickname='".trim($nickname)."',depast='".trim($depast)."',job='".trim($job)."',branch='".trim($branch)."',branchname='".trim($branchname)."' WHERE id='".trim($id)."' ";
            Yii::app()->msystem->createCommand($sql)->execute();
            echo "Message sent!";
        }else{
            $sql2="UPDATE sysuser SET name='".trim($name)."',password='".trim($password)."',fullname='".trim($fullname)."',surname='".trim($surname)."',nickname='".trim($nickname)."',depast='".trim($depast)."',job='".trim($job)."',branch='".trim($branch)."',branchname='".trim($branchname)."' WHERE id='".trim($id)."' ";
            Yii::app()->msystem->createCommand($sql2)->execute();
            echo "Message sent!";
        }
    }
}

public function actionListprogram()
{
    $result = Yii::app()->msystem->createCommand("SELECT * FROM sysprogram ORDER BY program_name ASC")->queryAll();
    $data = array();

    foreach ($result as $r) {
        $data[]=array(
            'program_id' => $r['id'],
            'program_name' => $r['program_name'],
        );
    }
    echo json_encode($data);
}

public function actionUserprogram()
{
    $id = $_GET["ref_user_id"];
    $sql ="SELECT
    SPG.id AS program_id,
    SPG.program_name,
    syu.`name`,
    SIP.ref_program_id,
    SIP.ref_user_id 
    FROM
    sysprogram AS SPG
    INNER JOIN sysintoprogram AS SIP ON SPG.id = SIP.ref_program_id
    INNER JOIN sysuser AS syu ON syu.id = SIP.ref_user_id 
    WHERE
    SIP.ref_user_id = '$id'";
    $res = Yii::app()->msystem->createCommand($sql)->queryAll();
    $data = array();
    foreach ($res as $r) {
        $data[]=array(
            'program_id' => $r['program_id'],
            'program_name' => $r['program_name'],
        );
    }
    echo json_encode($data);
}

public function actionSavelistpro(){
    $listprogram = $_POST['program_id'];
    $ref_user_id = $_POST['ref_user_id'];
    if(!empty($_POST)){
        $int = "INSERT INTO sysintoprogram SET ref_program_id='$listprogram',ref_user_id='$ref_user_id' ";
        Yii::app()->msystem->createCommand($int)->execute();
        $sql="SELECT * FROM sysmenu WHERE program_id=$listprogram";
        $result = Yii::app()->msystem->createCommand($sql)->queryAll();
        foreach ($result as $r) {
            $str="INSERT INTO sysusermenu SET menu_id='".$r["menu_id"]."',program_id='".$r["program_id"]."',user_id='$ref_user_id',views=1,creates=1,edits=0,deletes=0,approves=0,printed=0";
            Yii::app()->msystem->createCommand($str)->execute();
        }
    }
}


public function actionDelprogram(){
    if(!empty($_POST)){
        $sql="DELETE FROM sysintoprogram WHERE ref_user_id='".$_POST['ref_user_id']."'";
        $sql2="DELETE FROM sysusermenu WHERE user_id='".$_POST['ref_user_id']."' ";
        Yii::app()->msystem->createCommand($sql)->execute();
        Yii::app()->msystem->createCommand($sql2)->execute();
    }
}

public function actionPopupmanage()
{
    $this->renderPartial("popupmanage");
}

public function actionDataacc(){

    $id_pro = $_GET["program_id"];
    $id_user = $_GET["id"];

    $sqlmenu = "SELECT
    s.menu_id,
    s.menu_name,
    b.views,b.creates,b.edits,b.deletes,b.approves,b.printed,b.menu_id AS menu
    FROM
    sysmenu s 
    LEFT JOIN sysusermenu b ON s.program_id=b.program_id AND s.menu_id=b.menu_id AND b.user_id=$id_user 
    WHERE s.program_id=$id_pro "; 
    $result = Yii::app()->msystem->createCommand($sqlmenu)->queryAll();
    $data=array();
    $n=1;
    foreach ($result as $r) {
        if($r["views"]==null){
            $r["views"]=0;
        }if($r["creates"]==null){
            $r["creates"]=0;
        }if($r["edits"]==null){
            $r["edits"]=0;
        }if($r["deletes"]==null){
            $r["deletes"]=0;
        }if($r["approves"]==null){
            $r["approves"]=0;
        }if($r["printed"]==null){
            $r["printed"]=0;
        }

        $data[]=array(
            'no'=> $n,
            'menu' => $r['menu'],
            'menu_id' => ($r['menu_id']),
            'menu_name' => ($r['menu_name']),
            'views' => trim($r["views"]),
            'creates' => trim($r['creates']),
            'edits' => trim($r['edits']),
            'deletes' => trim($r['deletes']),
            'approves' => trim($r['approves']),
            'printed' => trim($r['printed'])
        );  
        $n++;
    }
    echo json_encode($data);

}

public function actionEditaccess(){

    $program_id = $_POST['program_id'];
    $id = $_POST['id'];
    $menu = $_POST['menu'];
    $menu_id = $_POST['menu_id'];
    $views = $_POST['views'];
    $creates = $_POST['creates'];
    $edits = $_POST['edits'];
    $deletes = $_POST['deletes'];
    $approves = $_POST['approves'];
    $printed = $_POST['printed'];


    if($views=='false'){
        $views = 0;
    }elseif($views=='true') {
        $views = 1;
    }
    if($creates=='false'){
        $creates = 0;
    }elseif($creates=='true') {
     $creates = 1;
 }
 if($edits=='false'){
    $edits =  0;
}elseif($edits=='true') {
    $edits = 1;
}
if($deletes=='false'){
   $deletes = 0;
}elseif($deletes=='true') {
    $deletes = 1;
}
if($approves=='false'){
    $approves = 0;
}elseif ($approves=='true') {
    $approves = 1;
}
if($printed=='false'){
    $printed = 0;
}elseif ($printed=='true') {
    $printed = 1;
}


if (!empty($_POST['menu_name']) == 'true') {

 

    if($menu==''){
        $int = "INSERT INTO sysusermenu SET
        menu_id='".$menu_id."',
        program_id = '".$program_id."',
        user_id = '".$id."',
        views='".$views."',
        creates='".$creates."',
        edits='".$edits."',
        deletes='".$deletes."',
        approves='".$approves."',
        printed='".$printed."' ";
        Yii::app()->msystem->createCommand($int)->execute();                        
    }else{
       $sql="UPDATE sysusermenu SET 
       views='".$views."',
       creates='".$creates."',
       edits='".$edits."',
       deletes='".$deletes."',
       approves='".$approves."',
       printed='".$printed."'
       WHERE menu_id='".$menu_id."' AND program_id='".$program_id."' AND user_id='".$id."' ";
       Yii::app()->msystem->createCommand($sql)->execute();
   }
}
}

}
?>