<?php
class ReprintController extends CController
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
	public function actionUpdatestatus()
	{
		if($_POST['save']==true){
			$rq=$_POST['rq'];
			$sql="UPDATE request.reqhead SET reqprint='0' WHERE rddoc='$rq' ";
			Yii::app()->db2->createCommand($sql)->execute();
		}
	}
	public function actionUpdatestatus2()
	{
		if($_POST['save']==true){
			$rq=$_POST['rq'];
			$sql="UPDATE request.reqhead SET reqprint='0',approve='0' WHERE rddoc='$rq' ";
			Yii::app()->db2->createCommand($sql)->execute();
		}
	}
	public function actionDatarq()
	{

		$str="SELECT R.* FROM (SELECT 
		a.rddoc, 
		a.rdate, 
		a.`subject`, 
		a.descript, 
		a.totalamount,  
		a.depart, 
		CASE 
		WHEN a.approve=0 THEN 'รออนุมัติ(print ส่ง)' 
		WHEN a.approve=1 THEN 'แจ้งแก้ไข' 
		WHEN a.approve=2 THEN 'ตรวจสอบแล้ว' 
		WHEN a.approve=3 THEN 'อนุมัติแล้ว' 
		WHEN a.approve=4 THEN 'ตั้งหนี้' 
		WHEN a.approve=5 THEN 'ตั้งเบิก/รอจ่าย'
		WHEN a.approve=6 THEN 'จ่ายแล้วรอใบเสร็จ'
		WHEN a.approve=7 THEN 'รับใบเสร็จ'
		WHEN a.approve=8 THEN 'ยกเลิก'
		END AS approve,
		CONCAT('[',a.ref_user_id,'] ',TRIM(b.fullname),' ',TRIM(b.surname),', ',TRIM(b.nickname)) AS refname 
		FROM 
		request.reqhead AS a 
		INNER JOIN msystem.sysuser AS b ON a.ref_user_id = b.`name` ";

	//where parameter
		$where=" WHERE ";

		if(!empty($_GET['rq'])){
			$str.=$where." (a.rddoc LIKE '%".TRIM($_GET['rq'])."%') ";
			$where=" AND ";
		}


		$str.=") AS R ";
	//ALL condition

		//fillter
		if (isset($_GET['filterscount']))
		{
			$filterscount = $_GET['filterscount'];
			
			if ($filterscount > 0)
			{
				$where = " WHERE (";
				$tmpdatafield = "";
				$tmpfilteroperator = "";
				for ($i=0; $i < $filterscount; $i++)
				{
					// get the filter's value.
					$filtervalue = $_GET["filtervalue" . $i];
					// get the filter's condition.
					$filtercondition = $_GET["filtercondition" . $i];
					// get the filter's column.
					$filterdatafield = $_GET["filterdatafield" . $i];
					// get the filter's operator.
					$filteroperator = $_GET["filteroperator" . $i];
					
					if ($tmpdatafield == "")
					{
						$tmpdatafield = $filterdatafield;			
					}
					else if ($tmpdatafield <> $filterdatafield)
					{
						$where .= ")AND(";
					}
					else if ($tmpdatafield == $filterdatafield)
					{
						if ($tmpfilteroperator == 0)
						{
							$where .= " AND ";
						}
						else $where .= " OR ";	
					}
					
					// build the "WHERE" clause depending on the filter's condition, value and datafield.
					if($filterdatafield=='rdate'){
						$filtervalue=MyClass::insertDate($filtervalue);
					}
					switch($filtercondition)
					{
						case "NOT_EMPTY":
						case "NOT_NULL":
						$where .= " " . $filterdatafield . " NOT LIKE '" . "" ."'";
						break;
						case "EMPTY":
						case "NULL":
						$where .= " " . $filterdatafield . " LIKE '" . "" ."'";
						break;
						case "CONTAINS_CASE_SENSITIVE":
						$where .= " BINARY  " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
						break;
						case "CONTAINS":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
						break;
						case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
						$where .= " BINARY " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
						break;
						case "DOES_NOT_CONTAIN":
						$where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
						break;
						case "EQUAL_CASE_SENSITIVE":
						$where .= " BINARY " . $filterdatafield . " = '" . $filtervalue ."'";
						break;
						case "EQUAL":
						$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
						break;
						case "NOT_EQUAL_CASE_SENSITIVE":
						$where .= " BINARY " . $filterdatafield . " <> '" . $filtervalue ."'";
						break;
						case "NOT_EQUAL":
						$where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
						break;
						case "GREATER_THAN":
						$where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
						break;
						case "LESS_THAN":
						$where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
						break;
						case "GREATER_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
						break;
						case "LESS_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
						break;
						case "STARTS_WITH_CASE_SENSITIVE":
						$where .= " BINARY " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
						break;
						case "STARTS_WITH":
						$where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
						break;
						case "ENDS_WITH_CASE_SENSITIVE":
						$where .= " BINARY " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
						break;
						case "ENDS_WITH":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
						break;
					}

					if ($i == $filterscount- 1)
					{
						$where .= ")";
					}

					$tmpfilteroperator = $filteroperator;
					$tmpdatafield = $filterdatafield;
				}
				

				$str = $str.$where;

				$filterquery = $str;
			}
		}

		//sorted by desc
		if (isset($_GET['sortdatafield']))
		{

			$sortfield = $_GET['sortdatafield'];
			$sortorder = $_GET['sortorder'];
			
			if ($sortorder != '')
			{
				if ($_GET['filterscount'] == 0)
				{
					if ($sortorder == "desc")
					{
						$str = $str." ORDER BY" . " " . $sortfield . " DESC ";
					}
					else if ($sortorder == "asc")
					{
						$str = $str." ORDER BY" . " " . $sortfield . " ASC ";
					}
				}
				else
				{
					if ($sortorder == "desc")
					{
						$filterquery .= " ORDER BY" . " " . $sortfield . " DESC ";
					}
					else if ($sortorder == "asc")
					{
						$filterquery .= " ORDER BY" . " " . $sortfield . " ASC ";
					}
					$str = $filterquery;
				}
			}
		}else{
			$str.="ORDER BY rddoc DESC ";
		}


		
		$pagenum = !empty($_GET['pagenum'])?$_GET['pagenum']:0;
		$pagesize = !empty($_GET['pagesize'])?$_GET['pagesize']:0;
		$start = $pagenum * $pagesize;

		
		$allrows=Yii::app()->db2->createCommand($str)->queryAll();
		$total_rows=count($allrows);

		if(!empty($start)){
			$str = $str." LIMIT $start, $pagesize";
		}



		$result=Yii::app()->db2->createCommand($str)->queryAll();
		$data=array();
		$records=array();

		foreach ($result as $r) {

			$records[]=array(
				'rddoc'=>$r['rddoc'],
				'rdate'=>$r['rdate'],
				'subject'=>$r['subject'],
				'descript'=>$r['descript'],
				'depart'=>$r['depart'],
				'approve'=>$r['approve'],
				'totalamount'=>$r['totalamount'],
				'refname'=>$r['refname'],
			);
		}

		$data[]=array(
			'TotalRows'=>$total_rows,
			'Rows'=>$records
		);

		echo json_encode($data);

	}

} ?>