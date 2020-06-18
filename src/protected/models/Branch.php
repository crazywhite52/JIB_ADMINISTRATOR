<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 * @property string $branch
 * @property string $shotname
 * @property string $branchname
 * @property string $regcode
 * @property string $zone
 * @property string $address1
 * @property string $address2
 * @property string $tel
 * @property string $fax
 * @property string $status
 * @property string $chk
 * @property string $branchgroup
 * @property string $codename
 * @property string $type
 * @property integer $region
 * @property integer $bzone
 * @property string $salestype
 * @property integer $numorder
 * @property string $prosales
 * @property string $czone
 * @property string $owners
 * @property string $bsize
 * @property integer $newbranch
 * @property string $textzone
 * @property integer $printorder
 * @property integer $loadweb
 * @property integer $loadwholesale
 * @property integer $lazadaweb
 * @property integer $loadall
 * @property integer $loadall_ws
 * @property integer $include_trans
 * @property string $upd
 */
class Branch extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Branch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'branch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch, branchname, zone, address1, address2, tel, fax, chk, branchgroup, codename, type, upd', 'required'),
			array('region, bzone, numorder, newbranch, printorder, loadweb, loadwholesale, lazadaweb, loadall, loadall_ws, include_trans', 'numerical', 'integerOnly'=>true),
			array('branch, zone, address1, address2, tel, fax, branchgroup, codename, type, salestype, prosales, czone', 'length', 'max'=>45),
			array('shotname, bsize', 'length', 'max'=>10),
			array('branchname', 'length', 'max'=>200),
			array('regcode', 'length', 'max'=>4),
			array('status, chk', 'length', 'max'=>1),
			array('owners', 'length', 'max'=>50),
			array('textzone', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('branch, shotname, branchname, regcode, zone, address1, address2, tel, fax, status, chk, branchgroup, codename, type, region, bzone, salestype, numorder, prosales, czone, owners, bsize, newbranch, textzone, printorder, loadweb, loadwholesale, lazadaweb, loadall, loadall_ws, include_trans, upd', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'branch' => 'Branch',
			'shotname' => 'Shotname',
			'branchname' => 'Branchname',
			'regcode' => 'Regcode',
			'zone' => 'Zone',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'tel' => 'Tel',
			'fax' => 'Fax',
			'status' => 'Status',
			'chk' => 'Chk',
			'branchgroup' => 'Branchgroup',
			'codename' => 'Codename',
			'type' => 'Type',
			'region' => 'Region',
			'bzone' => 'Bzone',
			'salestype' => 'Salestype',
			'numorder' => 'Numorder',
			'prosales' => 'Prosales',
			'czone' => 'Czone',
			'owners' => 'Owners',
			'bsize' => 'Bsize',
			'newbranch' => 'Newbranch',
			'textzone' => 'Textzone',
			'printorder' => 'Printorder',
			'loadweb' => 'Loadweb',
			'loadwholesale' => 'Loadwholesale',
			'lazadaweb' => 'Lazadaweb',
			'loadall' => 'Loadall',
			'loadall_ws' => 'Loadall Ws',
			'include_trans' => 'Include Trans',
			'upd' => 'Upd',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('branch',$this->branch,true);
		$criteria->compare('shotname',$this->shotname,true);
		$criteria->compare('branchname',$this->branchname,true);
		$criteria->compare('regcode',$this->regcode,true);
		$criteria->compare('zone',$this->zone,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('chk',$this->chk,true);
		$criteria->compare('branchgroup',$this->branchgroup,true);
		$criteria->compare('codename',$this->codename,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('region',$this->region);
		$criteria->compare('bzone',$this->bzone);
		$criteria->compare('salestype',$this->salestype,true);
		$criteria->compare('numorder',$this->numorder);
		$criteria->compare('prosales',$this->prosales,true);
		$criteria->compare('czone',$this->czone,true);
		$criteria->compare('owners',$this->owners,true);
		$criteria->compare('bsize',$this->bsize,true);
		$criteria->compare('newbranch',$this->newbranch);
		$criteria->compare('textzone',$this->textzone,true);
		$criteria->compare('printorder',$this->printorder);
		$criteria->compare('loadweb',$this->loadweb);
		$criteria->compare('loadwholesale',$this->loadwholesale);
		$criteria->compare('lazadaweb',$this->lazadaweb);
		$criteria->compare('loadall',$this->loadall);
		$criteria->compare('loadall_ws',$this->loadall_ws);
		$criteria->compare('include_trans',$this->include_trans);
		$criteria->compare('upd',$this->upd,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	 public static function BranchList() {
        $arr = array();
        //$arr[null] = "";

        $criteria = new CDbCriteria();
        $criteria->order = "branchname ASC";

        $data = Branch::model()->findAll($criteria);
        foreach ($data as $r) {
            $arr[trim($r->branch)] = '['.trim($r->branch).']'.trim($r->branchname);
        }

        return $arr;
    }
    public function Brname($status) {
       $text=null;
       $sql="SELECT
				TRIM(jib.branch.branch) AS br,
				TRIM(jib.branch.branchname) AS br_name
				FROM
				jib.branch WHERE branch='$status'
				ORDER BY branchname ASC";
		$result=Yii::app()->db->createCommand($sql)->queryRow();
		$text='['.$result['br'].']'.' '.$result['br_name'];
        return $text;
    }

}