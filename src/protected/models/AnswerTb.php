<?php

/**
 * This is the model class for table "answer_tb".
 *
 * The followings are the available columns in table 'answer_tb':
 * @property integer $answerid
 * @property string $answer
 * @property string $upd
 * @property string $auther
 * @property string $no_id
 */
class AnswerTb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AnswerTb the static model class
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
		return 'answer_tb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('answer', 'length', 'max'=>250),
			array('auther, no_id', 'length', 'max'=>50),
			array('upd', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('answerid, answer, upd, auther, no_id', 'safe', 'on'=>'search'),
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
			'answerid' => 'Answerid',
			'answer' => 'Answer',
			'upd' => 'Upd',
			'auther' => 'Auther',
			'no_id' => 'No',
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

		$criteria->compare('answerid',$this->answerid);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('upd',$this->upd,true);
		$criteria->compare('auther',$this->auther,true);
		$criteria->compare('no_id',$this->no_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}