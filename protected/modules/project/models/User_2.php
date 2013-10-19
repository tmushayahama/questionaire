<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $lastname
 * @property string $firstname
 * @property string $organization
 * @property string $activkey
 * @property string $create_at
 * @property string $lastvisit_at
 * @property integer $superuser
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Profile $profile
 * @property UserProject[] $userProjects
 * @property UserQuestion[] $userQuestions
 */
class User_2 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User_2 the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, create_at', 'required'),
			array('superuser, status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>255),
			array('password, email, activkey', 'length', 'max'=>128),
			array('lastname, firstname', 'length', 'max'=>50),
			array('organization', 'length', 'max'=>100),
			array('lastvisit_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, lastname, firstname, organization, activkey, create_at, lastvisit_at, superuser, status', 'safe', 'on'=>'search'),
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
			'profile' => array(self::HAS_ONE, 'Profile', 'user_id'),
			'userProjects' => array(self::HAS_MANY, 'UserProject', 'user_id'),
			'userQuestions' => array(self::HAS_MANY, 'UserQuestion', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'lastname' => 'Lastname',
			'firstname' => 'Firstname',
			'organization' => 'Organization',
			'activkey' => 'Activkey',
			'create_at' => 'Create At',
			'lastvisit_at' => 'Lastvisit At',
			'superuser' => 'Superuser',
			'status' => 'Status',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('organization',$this->organization,true);
		$criteria->compare('activkey',$this->activkey,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('lastvisit_at',$this->lastvisit_at,true);
		$criteria->compare('superuser',$this->superuser);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}