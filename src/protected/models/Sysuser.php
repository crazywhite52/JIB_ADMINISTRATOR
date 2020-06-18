<?php

/**
 * This is the model class for table "sysuser".
 *
 * The followings are the available columns in table 'sysuser':
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $fullname
 * @property string $surname
 * @property string $nickname
 * @property string $branch
 * @property string $branchname
 * @property integer $system
 * @property string $upd
 * @property string $depast
 * @property string $job
 * @property string $img
 */
class Sysuser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sysuser the static model class
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
		return 'sysuser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('system', 'numerical', 'integerOnly'=>true),
			array('name, nickname', 'length', 'max'=>50),
			array('password', 'length', 'max'=>256),
			array('fullname, surname, depast, job', 'length', 'max'=>80),
			array('branch, img', 'length', 'max'=>20),
			array('branchname', 'length', 'max'=>100),
			array('upd', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, password, fullname, surname, nickname, branch, branchname, system, upd, depast, job, img', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
			'password' => 'Password',
			'fullname' => 'Fullname',
			'surname' => 'Surname',
			'nickname' => 'Nickname',
			'branch' => 'Branch',
			'branchname' => 'Branchname',
			'system' => 'System',
			'upd' => 'Upd',
			'depast' => 'Depast',
			'job' => 'Job',
			'img' => 'Img',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('branch',$this->branch,true);
		$criteria->compare('branchname',$this->branchname,true);
		$criteria->compare('system',$this->system);
		$criteria->compare('upd',$this->upd,true);
		$criteria->compare('depast',$this->depast,true);
		$criteria->compare('job',$this->job,true);
		$criteria->compare('img',$this->img,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}