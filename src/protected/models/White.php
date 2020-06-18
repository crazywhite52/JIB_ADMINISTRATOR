<?php
class White
{
    public static function Listcat(){
        $str="SELECT classid,classname FROM class";
        $result=Yii::app()->db->createCommand($str)->queryAll();
        $arr=array();
        $arr[null]="--SELECT CATEGORY--";
        foreach($result as $r){
            $arr[trim($r['classid'])]=trim($r['classname']);
        }
        
        return $arr;
    }
    
    public static function Listbrandindex(){
        $str="SELECT DISTINCT
        impproduct.Brand
        FROM
        impproduct";
        $result=Yii::app()->db->createCommand($str)->queryAll();
        $arr=null;
        
        foreach($result as $r){
            $arr.="'".trim($r["Brand"])."',";
        }
        
        $arr=rtrim($arr,",");
        
        return $arr;

    }
}
?>
