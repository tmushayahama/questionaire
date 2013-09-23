<?php

/**
 * This is the model class for table "{{project}}".
 *
 * The followings are the available columns in table '{{project}}':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property string $create_at
 *
 * The followings are the available model relations:
 * @property Questionnaire[] $questionnaires
 * @property UserProject[] $userProjects
 */
class Project extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
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
		return '{{project}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, create_at', 'required'),
			array('name, type, description', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, description, create_at', 'safe', 'on'=>'search'),
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
			'questionnaires' => array(self::HAS_MANY, 'Questionnaire', 'project_id'),
			'userProjects' => array(self::HAS_MANY, 'UserProject', 'project_id'),
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
			'type' => 'Type',
			'description' => 'Description',
			'create_at' => 'Create At',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('create_at',$this->create_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}