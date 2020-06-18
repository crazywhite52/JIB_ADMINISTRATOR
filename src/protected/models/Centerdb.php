<?php

class Centerdb {

    public static function listBranch() {
        $result = Yii::app()->msystem->createCommand("SELECT * FROM sysuser ORDER BY branchname ASC")->queryAll();
        $data = array();
        
        foreach ($result as $r) {
            $data[null] = "เลือกสาขา";
            $data[trim($r["branch"])] = trim($r["branchname"]);
        }
        return $data;
    }
     public static function listBranch2() {
        $result = Yii::app()->db->createCommand("SELECT * FROM branch ORDER BY branchname ASC")->queryAll();
        $data = array();
        
        foreach ($result as $r) {
            $data[null] = "เลือกสาขา";
            $data[trim($r["branch"])] = '['.trim($r["branch"]).']'.trim($r["branchname"]);
        }
        return $data;
    }
    public static function listjobyear() {
        $result = Yii::app()->msystem->createCommand("SELECT * FROM es_result ORDER BY jobyear DESC")->queryAll();
        $data = array();
        $year=date("Y");
        foreach ($result as $r) {
            $data[$year] = $year;
            $data[trim($r["jobyear"])] = trim($r["jobyear"]);
        }
        return $data;
    }
    public static function levellist() {
        $result = Yii::app()->msystem->createCommand("SELECT * FROM es_levels ORDER BY id ASC")->queryAll();
        $data = array();
        
        foreach ($result as $r) {
            $data[null] = "เลือกระดับ";
            $data[trim($r["id"])] = trim($r["level_name"]);
        }
        return $data;
    }

    public static function Projectlist() {
        $result = Yii::app()->msystem->createCommand("SELECT * FROM sysprogram ORDER BY program_name ASC")->queryAll();
        $data = array();
        
        foreach ($result as $r) {
            $data[null] = "เลือกโปรแกรม";
            $data[trim($r["id"])] = '['.$r["id"].']'.' '.trim($r["program_name"]);
        }
        return $data;
    }
    public static function Depastlist(){
        $result = Yii::app()->msystem->createCommand("SELECT depast FROM sysuser WHERE depast NOT IN ('','#N/A') GROUP BY depast ORDER BY depast ASC")->queryAll();
        $data = array();

        foreach ($result as $r) {
            $data[null] = "เลือกแผนก";
            $data[trim($r["depast"])] = trim($r["depast"]);
        }
        return $data;
    }
     public static function Joblist(){
        $result = Yii::app()->msystem->createCommand("SELECT job FROM sysuser WHERE job NOT IN ('') GROUP BY job ORDER BY job ASC")->queryAll();
        $data = array();

        foreach ($result as $r) {
            $data[null] = "เลือกงาน";
            $data[trim($r["job"])] = trim($r["job"]);
        }
        return $data;
    }
    public static function Listprogram() {
        $result = Yii::app()->msystem->createCommand("SELECT * FROM sysprogram ORDER BY program_name ASC")->queryAll();
        $data = array();
        
        foreach ($result as $r) {
            $data[null] = "เลือกโปรแกรม";
            $data[trim($r["id"])] = trim($r["program_name"]);
        }
        return $data;
    }

}

?>
