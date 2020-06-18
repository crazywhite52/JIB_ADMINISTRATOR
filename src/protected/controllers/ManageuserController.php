<?php
class ManageuserController extends CController
{
    public function actionIndex()
    {
        $this->render("index");
    }
    public function actionAddprogram()
    {
       $listprogram = $_POST['program_id'];
       $ref_user_id = $_POST['ref_user_id'];
       $int = "INSERT INTO sysintoprogram SET ref_program_id='$listprogram',ref_user_id='$ref_user_id' ";
       Yii::app()->msystem->createCommand($int)->execute();

       $sql="SELECT * FROM sysmenu WHERE program_id=$listprogram";
       $result = Yii::app()->msystem->createCommand($sql)->queryAll();
       foreach ($result as $r) {
        $str="INSERT INTO sysusermenu SET menu_id='".$r["menu_id"]."',program_id='".$r["program_id"]."',user_id='$ref_user_id',views=0,creates=0,edits=0,deletes=0,approves=0,printed=0";
        Yii::app()->msystem->createCommand($str)->execute();
    }

    echo 'Message sent!';
}
public function actionDelpro()
{
    $sql="DELETE FROM sysintoprogram WHERE ref_program_id='".$_POST['ref_program_id']."' AND ref_user_id='".$_POST['ref_user_id']."'";
    Yii::app()->msystem->createCommand($sql)->execute();
    $sql2="DELETE FROM sysusermenu WHERE user_id='".$_POST['ref_user_id']."' AND program_id='".$_POST['ref_program_id']."'";
    Yii::app()->msystem->createCommand($sql2)->execute();
}
public function actionProuser()
{
    $prouser = $_GET["id"];

    $sql="SELECT
    SPG.id,
    SPG.program_name,
    SPG.program_text,
    SPG.program_user
    FROM
    sysprogram AS SPG
    LEFT JOIN sysintoprogram AS SIP ON SPG.id = SIP.ref_program_id
    WHERE
    SIP.ref_user_id = '$prouser'
    ORDER BY
    SPG.id ASC";
    $res = Yii::app()->msystem->createCommand($sql)->queryAll();

    $data=array();
    foreach ($res as $r) {
        if($r['program_user']==1){
            $st='เปิดใช้งาน';
        }else{
            $st='ปิดใช้งาน';
        }
        $data[]=array(
          'program_id' => $r['id'],
          'program_name' => $r['program_name'],
          'program_text' => $r['program_text'],
          'program_user' => $st,

      );
    }
    echo json_encode($data);
}
public function actionProjectlist()
{
    $project = $_POST["project"];

    $sql="SELECT * FROM sysprogram WHERE id='$project' ";
    $res = Yii::app()->msystem->createCommand($sql)->queryRow();
    if(!empty($res)){
        echo $res["id"] . "||" . trim($res["program_name"]) . "||" . $res["program_text"] . "||" . $res["program_user"];
    }
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
public function actionNuser($id = null)
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

    $this->render("nuser",array("id"=>$id,"data"=>$data));
}
public function actionUpdatauser()
{
    if(!empty($_POST)){

        $id=$_POST["id"];
        $name=$_POST["name"];
        $fullname=$_POST["fullname"];
        $surname=$_POST["surname"];
        $nickname=$_POST["nickname"];
        $depast=$_POST["depast"];
        $job=$_POST["job"];
        $branch=$_POST["branch"];
        $branchname=$_POST["branchname"];


        if($_POST["password"]=='' or $_POST["password"]=='null'){
            $sql="UPDATE sysuser SET name='".trim($name)."',fullname='".trim($fullname)."',surname='".trim($surname)."',nickname='".trim($nickname)."',depast='".trim($depast)."',job='".trim($job)."',branch='".trim($branch)."',branchname='".trim($branchname)."' WHERE id='".trim($id)."' ";
            Yii::app()->msystem->createCommand($sql)->execute();
            echo "Message sent!";
        }else{
            $password=md5($_POST["password"]);
            $sql2="UPDATE sysuser SET name='".trim($name)."',password='".$password."',fullname='".trim($fullname)."',surname='".trim($surname)."',nickname='".trim($nickname)."',depast='".trim($depast)."',job='".trim($job)."',branch='".trim($branch)."',branchname='".trim($branchname)."' WHERE id='".trim($id)."' ";
            Yii::app()->msystem->createCommand($sql2)->execute();
            echo "Message sent!";
        }


    }
}
public function actionListprogram()
{
    $result = Yii::app()->msystem->createCommand("SELECT * FROM sysprogram ORDER BY id ASC")->queryAll();
    $data = array();
    foreach ($result as $r) {
        if($r['program_user']==0){
            $st_pro="ไม่ใช้งาน";
        }else if ($r['program_user']==1) {
            $st_pro="ใช้งาน";
        }
        $data[]=array(
            'program_id' => $r['id'],
            'program_user' =>$st_pro,
            'program_name' => $r['program_name'],
            'program_text' => $r['program_text']
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
    SPG.program_text,
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
            'program_text' => $r['program_text']
        );
    }
    echo json_encode($data);
}
public function actionDelprogram(){
    if(!empty($_POST)){
        $listprogram = $_POST['program_id'];
        $ref_user_id = $_POST['ref_user_id'];

        $sql="DELETE FROM sysintoprogram WHERE ref_user_id='".$ref_user_id."' AND ref_program_id='$listprogram' ";
        $sql2="DELETE FROM sysusermenu WHERE user_id='".$ref_user_id."' AND program_id='$listprogram' ";
        Yii::app()->msystem->createCommand($sql)->execute();
        Yii::app()->msystem->createCommand($sql2)->execute();
    }
}
public function actionSavelistpro(){

    if(!empty($_POST)){
        $listprogram = $_POST['program_id'];
        $ref_user_id = $_POST['ref_user_id'];
        $int = "INSERT INTO sysintoprogram SET ref_program_id='$listprogram',ref_user_id='$ref_user_id' ";
        $chkerr=Yii::app()->msystem->createCommand($int)->execute();

        // if($chkerr){

        // }else{
        //     $int = "UPDATE sysintoprogram SET ref_program_id='$listprogram',ref_user_id='$ref_user_id' WHERE ref_user_id='$ref_user_id' AND ref_program_id='$listprogram' ";
        //     $chkerr=Yii::app()->msystem->createCommand($int)->execute();
        // }
        $sql="SELECT * FROM sysmenu WHERE program_id=$listprogram";
        $result = Yii::app()->msystem->createCommand($sql)->queryAll();
        $result2 = Yii::app()->msystem->createCommand($sql)->queryRow();

        $chlp="SELECT
        sysusermenu.menu_id,
        sysusermenu.program_id,
        sysusermenu.user_id,
        sysusermenu.views,
        sysusermenu.creates,
        sysusermenu.edits,
        sysusermenu.deletes,
        sysusermenu.approves,
        sysusermenu.printed
        FROM
        sysusermenu
        WHERE program_id='$listprogram' AND user_id='".$ref_user_id."' ";
        $prolist = Yii::app()->msystem->createCommand($chlp)->queryAll();
        if($prolist!=''||$prolist!=null){
            foreach ($result as $r) {
                $str="INSERT INTO sysusermenu SET menu_id='".$r["menu_id"]."',program_id='".$r["program_id"]."',user_id='$ref_user_id',views=0,creates=0,edits=0,deletes=0,approves=0,printed=0";
                Yii::app()->msystem->createCommand($str)->execute();
            }
        }else{

        }
    }
}
public function actionPopupmanage()
{
    $this->renderPartial("popupmanage");
}
public function actionDataacc()
{

    $id_pro = $_GET["program_id"];
    $id_user = $_GET["id"];

    $sqlmenu = "SELECT
    b.menu_id AS menu,
    b.menu_id,
    a.program_id,
    a.menu_name,
    b.views,
    b.creates,
    b.edits,
    b.deletes,
    b.approves,
    b.printed
    FROM
    sysmenu AS a
    LEFT JOIN sysusermenu b ON a.program_id = b.program_id
    AND a.menu_id = b.menu_id
    AND b.user_id = '$id_user'
    WHERE
    a.program_id = '$id_pro'
    ORDER BY
    a.menu_id ASC"; 
    $result = Yii::app()->msystem->createCommand($sqlmenu)->queryAll();
    $data=array();

    foreach ($result as $key => $r) {
        if($r["views"]==null){
            $views=0;
        }else{
            $views=$r["views"];
        }
        if($r["creates"]==null){
            $creates=0;
        }else{
            $creates=$r["creates"];
        }
        if($r["edits"]==null){
            $edits=0;
        }else{
            $edits=$r["edits"];
        }
        if($r["deletes"]==null){
            $deletes=0;
        }else{
            $deletes=$r["deletes"];
        }
        if($r["approves"]==null){
            $approves=0;
        }else{
            $approves=$r["approves"];
        }
        if($r["printed"]==null){
            $printed=0;
        }else{
            $printed=$r["printed"];
        }

        $data[]=array(
            'no'=> $key+1,
            'menu_id' => $r['menu_id'],
            'menu_name' => $r['menu_name'],
            'views' => $views,
            'creates' => $creates,
            'edits' => $edits,
            'deletes' => $deletes,
            'approves' => $approves,
            'printed' => $printed
        );  

    }
    echo json_encode($data);

}

public function actionEditaccess()
{
    $program_id = $_POST['program_id'];
    $id = $_POST['id'];
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

        // $int = "INSERT INTO sysusermenu SET
        // menu_id='".$menu_id."',
        // program_id = '".$program_id."',
        // user_id = '".$id."',
        // views='".$views."',
        // creates='".$creates."',
        // edits='".$edits."',
        // deletes='".$deletes."',
        // approves='".$approves."',
        // printed='".$printed."' ";
        // echo $int;
        // Yii::app()->db->createCommand($int)->execute();                        

 $sql="UPDATE sysusermenu SET 
 views='".$views."',
 creates='".$creates."',
 edits='".$edits."',
 deletes='".$deletes."',
 approves='".$approves."',
 printed='".$printed."'
 WHERE menu_id='".$menu_id."' AND program_id='".$program_id."' AND user_id='".$id."' ";
 echo $sql;
 Yii::app()->msystem->createCommand($sql)->execute();

}
}


}
?>