<?php

/**
 * This is the model class for table "es_access".
 *
 * The followings are the available columns in table 'es_access':
 * @property integer $id
 * @property string $detail
 * @property integer $creates
 * @property integer $reads
 * @property integer $updates
 * @property integer $deletes
 * @property string $upd
 */
class EsAccess extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EsAccess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return CDbConnection database connection
	 */
	public function getDbConnection()
	{
		return Yii::app()->msystem;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'es_access';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('creates, reads, updates, deletes', 'numerical', 'integerOnly'=>true),
			array('detail', 'length', 'max'=>100),
			array('upd', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, detail, creates, reads, updates, deletes, upd', 'safe', 'on'=>'search'),
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
			'detail' => 'Detail',
			'creates' => 'Creates',
			'reads' => 'Reads',
			'updates' => 'Updates',
			'deletes' => 'Deletes',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('creates',$this->creates);
		$criteria->compare('reads',$this->reads);
		$criteria->compare('updates',$this->updates);
		$criteria->compare('deletes',$this->deletes);
		$criteria->compare('upd',$this->upd,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}