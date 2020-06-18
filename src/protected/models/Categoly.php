<?php

/**
 * This is the model class for table "class".
 *
 * The followings are the available columns in table 'class':
 * @property string $classid
 * @property string $classname
 * @property string $category
 * @property string $cancel
 * @property string $upd
 */
class Categoly extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categoly the static model class
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
		return 'class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('classid, classname, category, cancel, upd', 'required'),
			array('classid, classname, category', 'length', 'max'=>45),
			array('cancel', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('classid, classname, category, cancel, upd', 'safe', 'on'=>'search'),
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
			'classid' => 'Classid',
			'classname' => 'Classname',
			'category' => 'Category',
			'cancel' => 'Cancel',
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

		$criteria->compare('classid',$this->classid,true);
		$criteria->compare('classname',$this->classname,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('cancel',$this->cancel,true);
		$criteria->compare('upd',$this->upd,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function CategolyList() {
        $arr = array();
        $arr[null] = "เลือกประเภทสินค้า";

        $criteria = new CDbCriteria();
        $criteria->order = "classname ASC";

        $data = Categoly::model()->findAll($criteria);
        foreach ($data as $r) {
            $arr[trim($r->classid)] = '['.trim($r->classid).']'.trim($r->classname);
        }

        return $arr;
    }
}