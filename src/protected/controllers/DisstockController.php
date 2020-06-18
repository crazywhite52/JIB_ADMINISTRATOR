<?php 

class DisstockController extends CController
{
    public function actionIndex()
    {
        $this->render("index");
    }
    public function actionDissdata()
    {
    	$classid=$_GET['classid'];
    	$product=$_GET['product'];
    	$branch=$_GET['branch'];

    	$str="	SELECT * FROM odb_orderbranch a 
    				INNER JOIN impproduct b ON a.product=b.Product 
    			WHERE a.orddate <= CURDATE() AND a.`status` IN (0,8) AND a.approve=1 AND a.ordstatus=0 
    			AND a.stockprint IN(0,1,2) ";

    	if(!empty($classid) || $classid!=''){
    		$str.=" AND b.CATEGORYID='$classid'";
    	}

    	if(!empty($product) || $product!=''){
    		$str.=" AND a.product LIKE '%".$product."%'";
    	}

    	if(!empty($branch) || $branch!=''){
    		$str.=" AND a.stockbranch IN('".$branch."')";
    	}

    	$result = Yii::app()->db->createCommand($str)->queryAll();
    	$data = array();
    	foreach($result as $r){
			$data[] = array(
					'ordid' => $r['ordid'],
					'orddate' => $r['orddate'],
					'product' => $r['product'],
					'Name' => $r['Name'],
					'ordnum' => $r['ordnum'],
					'authorname' => $r['authorname'],
					'stockbranch' => $r['stockbranch'],
					'stockprint' => $r['stockprint'],
					
			);
		}
		echo json_encode($data);

    }

    public function actionUpdateorderbranch()
    {
    	$classid=$_POST['classid'];
    	$product=$_POST['product'];
    	$branch=$_POST['branch'];

        $log = "INSERT INTO odb_clearlog (ordid,orddate,branch,product,ordnum,oldstatus,stockbranch) 
        SELECT a.ordid,a.orddate,a.branch,a.product,a.ordnum,a.`status`,a.stockbranch FROM odb_orderbranch a JOIN impproduct b ON a.product=b.Product 
        WHERE a.orddate <= CURDATE() AND a.`status` IN(0,8) AND a.approve=1 AND a.ordstatus=0 AND a.stockprint IN(0,1,2)";

        if(!empty($classid) || $classid!=''){
            $log.=" AND b.CATEGORYID='$classid'";
        }

        if(!empty($product) || $product!=''){
            $log.=" AND a.product LIKE '%".$product."%'";
        }

        if(!empty($branch) || $branch!=''){
            $log.=" AND a.stockbranch IN('".$branch."')";
        }
        
       Yii::app()->db->createCommand($log)->execute();



    	$str="	UPDATE  odb_orderbranch a JOIN impproduct b ON a.product=b.Product  SET  a.`status`=2 
    		WHERE a.orddate <= CURDATE() AND a.`status` IN(0,8) AND a.approve=1 AND a.ordstatus=0 AND a.stockprint IN(0,1,2)";

            

    	if(!empty($classid) || $classid!=''){
    		$str.=" AND b.CATEGORYID='$classid'";
    	}

    	if(!empty($product) || $product!=''){
    		$str.=" AND a.product LIKE '%".$product."%'";
    	}

    	if(!empty($branch) || $branch!=''){
    		$str.=" AND a.stockbranch IN('".$branch."')";
    	}

    	Yii::app()->db->createCommand($str)->execute();

    }

    public function actionUpdatefast()
    {
        $str="UPDATE  odb_orderbranch a JOIN impproduct b ON a.product=b.Product  SET  a.`status`=2 
            WHERE a.orddate < '2019-01-01' AND a.`status` IN(0,8) AND a.approve=1 AND a.ordstatus=0 AND a.stockprint IN(0,1,2)";
         Yii::app()->db->createCommand($str)->execute();       
        
    }

public function actionUpdateisprint()
    {
        $str="UPDATE  odb_orderbranch a JOIN impproduct b ON a.product=b.Product  SET  a.`status`=2 
            WHERE  a.`status` IN(0,8) AND a.approve=1 AND a.ordstatus=0 AND a.stockprint IN(2)";
         echo Yii::app()->db->createCommand($str)->execute();       
        
    }


	
}
 ?>