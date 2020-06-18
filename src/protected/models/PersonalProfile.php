<?php

/**
 * This is the model class for table "personal_profile".
 *
 * The followings are the available columns in table 'personal_profile':
 * @property string $personal_id
 * @property string $referent_itec
 * @property integer $location
 * @property string $personal_image
 * @property integer $personal_title
 * @property string $personal_name
 * @property string $personal_lastname
 * @property string $personal_nickname
 * @property string $eng_firstname
 * @property string $eng_lastname
 * @property string $eng_nickname
 * @property integer $personal_line
 * @property integer $personal_depart
 * @property integer $personal_rank
 * @property integer $personal_level
 * @property string $personal_job
 * @property string $personal_startdate
 * @property integer $personal_holiday
 * @property integer $personal_sex
 * @property string $citizen_id
 * @property string $birthday
 * @property string $nationlity
 * @property string $race
 * @property string $religion
 * @property integer $age
 * @property integer $group_blood
 * @property integer $height
 * @property integer $weight
 * @property string $home_land
 * @property string $cur_no
 * @property string $cur_group
 * @property string $cur_village
 * @property string $cur_road
 * @property string $cur_zone
 * @property string $cur_area
 * @property string $cur_city
 * @property string $cur_post
 * @property string $cur_tel
 * @property string $cur_phone
 * @property string $cur_fax
 * @property string $cur_email
 * @property string $add_no
 * @property string $add_group
 * @property string $add_village
 * @property string $add_road
 * @property string $add_zone
 * @property string $add_area
 * @property string $add_city
 * @property string $add_post
 * @property string $add_tel
 * @property string $add_phone
 * @property string $add_fax
 * @property string $with_status
 * @property string $home_status
 * @property string $family_status
 * @property string $mate_name
 * @property string $mate_job
 * @property string $mate_jlocation
 * @property integer $child
 * @property integer $child_study
 * @property integer $child_num
 * @property string $father_name
 * @property string $father_job
 * @property string $father_life_status
 * @property string $mother_name
 * @property string $mother_job
 * @property string $mother_life_status
 * @property string $soldier_status
 * @property string $exi_name
 * @property string $exi_relation
 * @property string $exi_address
 * @property string $exi_tel
 * @property string $exi_phone
 * @property integer $status
 * @property string $upd
 * @property string $cur_alley
 * @property string $add_alley
 * @property integer $personal_levelrank
 */
class PersonalProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PersonalProfile the static model class
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
		return Yii::app()->db3;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'personal_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('upd', 'required'),
			array('location, personal_title, personal_line, personal_depart, personal_rank, personal_level, personal_holiday, personal_sex, age, group_blood, height, weight, child, child_study, child_num, status, personal_levelrank', 'numerical', 'integerOnly'=>true),
			array('personal_id, referent_itec, cur_post, add_post, with_status, home_status, family_status, father_life_status, mother_life_status, soldier_status, exi_tel', 'length', 'max'=>10),
			array('personal_image, citizen_id, cur_fax, add_fax, exi_phone', 'length', 'max'=>20),
			array('personal_name, personal_lastname, eng_firstname, eng_lastname, home_land, cur_village, cur_road, cur_zone, cur_area, cur_city, cur_email, add_village, add_road, add_zone, add_area, add_city, mate_job, father_job, mother_job, cur_alley, add_alley', 'length', 'max'=>100),
			array('personal_nickname, eng_nickname', 'length', 'max'=>45),
			array('personal_job, mate_jlocation', 'length', 'max'=>150),
			array('nationlity, race, religion, cur_no, cur_group, add_no, add_group, exi_relation', 'length', 'max'=>50),
			array('cur_tel, cur_phone, add_tel, add_phone', 'length', 'max'=>40),
			array('mate_name, father_name, mother_name, exi_name', 'length', 'max'=>200),
			array('exi_address', 'length', 'max'=>255),
			array('personal_startdate, birthday', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('personal_id, referent_itec, location, personal_image, personal_title, personal_name, personal_lastname, personal_nickname, eng_firstname, eng_lastname, eng_nickname, personal_line, personal_depart, personal_rank, personal_level, personal_job, personal_startdate, personal_holiday, personal_sex, citizen_id, birthday, nationlity, race, religion, age, group_blood, height, weight, home_land, cur_no, cur_group, cur_village, cur_road, cur_zone, cur_area, cur_city, cur_post, cur_tel, cur_phone, cur_fax, cur_email, add_no, add_group, add_village, add_road, add_zone, add_area, add_city, add_post, add_tel, add_phone, add_fax, with_status, home_status, family_status, mate_name, mate_job, mate_jlocation, child, child_study, child_num, father_name, father_job, father_life_status, mother_name, mother_job, mother_life_status, soldier_status, exi_name, exi_relation, exi_address, exi_tel, exi_phone, status, upd, cur_alley, add_alley, personal_levelrank', 'safe', 'on'=>'search'),
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
			'personal_id' => 'Personal',
			'referent_itec' => 'Referent Itec',
			'location' => 'Location',
			'personal_image' => 'Personal Image',
			'personal_title' => 'Personal Title',
			'personal_name' => 'Personal Name',
			'personal_lastname' => 'Personal Lastname',
			'personal_nickname' => 'Personal Nickname',
			'eng_firstname' => 'Eng Firstname',
			'eng_lastname' => 'Eng Lastname',
			'eng_nickname' => 'Eng Nickname',
			'personal_line' => 'Personal Line',
			'personal_depart' => 'Personal Depart',
			'personal_rank' => 'Personal Rank',
			'personal_level' => 'Personal Level',
			'personal_job' => 'Personal Job',
			'personal_startdate' => 'Personal Startdate',
			'personal_holiday' => 'Personal Holiday',
			'personal_sex' => 'Personal Sex',
			'citizen_id' => 'Citizen',
			'birthday' => 'Birthday',
			'nationlity' => 'Nationlity',
			'race' => 'Race',
			'religion' => 'Religion',
			'age' => 'Age',
			'group_blood' => 'Group Blood',
			'height' => 'Height',
			'weight' => 'Weight',
			'home_land' => 'Home Land',
			'cur_no' => 'Cur No',
			'cur_group' => 'Cur Group',
			'cur_village' => 'Cur Village',
			'cur_road' => 'Cur Road',
			'cur_zone' => 'Cur Zone',
			'cur_area' => 'Cur Area',
			'cur_city' => 'Cur City',
			'cur_post' => 'Cur Post',
			'cur_tel' => 'Cur Tel',
			'cur_phone' => 'Cur Phone',
			'cur_fax' => 'Cur Fax',
			'cur_email' => 'Cur Email',
			'add_no' => 'Add No',
			'add_group' => 'Add Group',
			'add_village' => 'Add Village',
			'add_road' => 'Add Road',
			'add_zone' => 'Add Zone',
			'add_area' => 'Add Area',
			'add_city' => 'Add City',
			'add_post' => 'Add Post',
			'add_tel' => 'Add Tel',
			'add_phone' => 'Add Phone',
			'add_fax' => 'Add Fax',
			'with_status' => 'With Status',
			'home_status' => 'Home Status',
			'family_status' => 'Family Status',
			'mate_name' => 'Mate Name',
			'mate_job' => 'Mate Job',
			'mate_jlocation' => 'Mate Jlocation',
			'child' => 'Child',
			'child_study' => 'Child Study',
			'child_num' => 'Child Num',
			'father_name' => 'Father Name',
			'father_job' => 'Father Job',
			'father_life_status' => 'Father Life Status',
			'mother_name' => 'Mother Name',
			'mother_job' => 'Mother Job',
			'mother_life_status' => 'Mother Life Status',
			'soldier_status' => 'Soldier Status',
			'exi_name' => 'Exi Name',
			'exi_relation' => 'Exi Relation',
			'exi_address' => 'Exi Address',
			'exi_tel' => 'Exi Tel',
			'exi_phone' => 'Exi Phone',
			'status' => 'Status',
			'upd' => 'Upd',
			'cur_alley' => 'Cur Alley',
			'add_alley' => 'Add Alley',
			'personal_levelrank' => 'Personal Levelrank',
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

		$criteria->compare('personal_id',$this->personal_id,true);
		$criteria->compare('referent_itec',$this->referent_itec,true);
		$criteria->compare('location',$this->location);
		$criteria->compare('personal_image',$this->personal_image,true);
		$criteria->compare('personal_title',$this->personal_title);
		$criteria->compare('personal_name',$this->personal_name,true);
		$criteria->compare('personal_lastname',$this->personal_lastname,true);
		$criteria->compare('personal_nickname',$this->personal_nickname,true);
		$criteria->compare('eng_firstname',$this->eng_firstname,true);
		$criteria->compare('eng_lastname',$this->eng_lastname,true);
		$criteria->compare('eng_nickname',$this->eng_nickname,true);
		$criteria->compare('personal_line',$this->personal_line);
		$criteria->compare('personal_depart',$this->personal_depart);
		$criteria->compare('personal_rank',$this->personal_rank);
		$criteria->compare('personal_level',$this->personal_level);
		$criteria->compare('personal_job',$this->personal_job,true);
		$criteria->compare('personal_startdate',$this->personal_startdate,true);
		$criteria->compare('personal_holiday',$this->personal_holiday);
		$criteria->compare('personal_sex',$this->personal_sex);
		$criteria->compare('citizen_id',$this->citizen_id,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('nationlity',$this->nationlity,true);
		$criteria->compare('race',$this->race,true);
		$criteria->compare('religion',$this->religion,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('group_blood',$this->group_blood);
		$criteria->compare('height',$this->height);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('home_land',$this->home_land,true);
		$criteria->compare('cur_no',$this->cur_no,true);
		$criteria->compare('cur_group',$this->cur_group,true);
		$criteria->compare('cur_village',$this->cur_village,true);
		$criteria->compare('cur_road',$this->cur_road,true);
		$criteria->compare('cur_zone',$this->cur_zone,true);
		$criteria->compare('cur_area',$this->cur_area,true);
		$criteria->compare('cur_city',$this->cur_city,true);
		$criteria->compare('cur_post',$this->cur_post,true);
		$criteria->compare('cur_tel',$this->cur_tel,true);
		$criteria->compare('cur_phone',$this->cur_phone,true);
		$criteria->compare('cur_fax',$this->cur_fax,true);
		$criteria->compare('cur_email',$this->cur_email,true);
		$criteria->compare('add_no',$this->add_no,true);
		$criteria->compare('add_group',$this->add_group,true);
		$criteria->compare('add_village',$this->add_village,true);
		$criteria->compare('add_road',$this->add_road,true);
		$criteria->compare('add_zone',$this->add_zone,true);
		$criteria->compare('add_area',$this->add_area,true);
		$criteria->compare('add_city',$this->add_city,true);
		$criteria->compare('add_post',$this->add_post,true);
		$criteria->compare('add_tel',$this->add_tel,true);
		$criteria->compare('add_phone',$this->add_phone,true);
		$criteria->compare('add_fax',$this->add_fax,true);
		$criteria->compare('with_status',$this->with_status,true);
		$criteria->compare('home_status',$this->home_status,true);
		$criteria->compare('family_status',$this->family_status,true);
		$criteria->compare('mate_name',$this->mate_name,true);
		$criteria->compare('mate_job',$this->mate_job,true);
		$criteria->compare('mate_jlocation',$this->mate_jlocation,true);
		$criteria->compare('child',$this->child);
		$criteria->compare('child_study',$this->child_study);
		$criteria->compare('child_num',$this->child_num);
		$criteria->compare('father_name',$this->father_name,true);
		$criteria->compare('father_job',$this->father_job,true);
		$criteria->compare('father_life_status',$this->father_life_status,true);
		$criteria->compare('mother_name',$this->mother_name,true);
		$criteria->compare('mother_job',$this->mother_job,true);
		$criteria->compare('mother_life_status',$this->mother_life_status,true);
		$criteria->compare('soldier_status',$this->soldier_status,true);
		$criteria->compare('exi_name',$this->exi_name,true);
		$criteria->compare('exi_relation',$this->exi_relation,true);
		$criteria->compare('exi_address',$this->exi_address,true);
		$criteria->compare('exi_tel',$this->exi_tel,true);
		$criteria->compare('exi_phone',$this->exi_phone,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('upd',$this->upd,true);
		$criteria->compare('cur_alley',$this->cur_alley,true);
		$criteria->compare('add_alley',$this->add_alley,true);
		$criteria->compare('personal_levelrank',$this->personal_levelrank);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function Listpersonal() {
        $result = Yii::app()->jibhr->createCommand("SELECT * FROM personal_profile a LEFT JOIN personal_title b ON a.personal_title=b.titleid WHERE a.personal_line='3' AND a.status='0'")->queryAll();
        $data = array();
        
        foreach ($result as $r) {
            $data[null] = "เลือกผู้รับงาน";
            $data[trim($r["personal_id"])] = '['.trim($r["personal_id"]).']'.trim($r["personal_name"]).' '.trim($r["personal_lastname"]).'('.trim($r["personal_nickname"]).')';
        }
        return $data;
    }
}