<?php

/**
 * This is the model class for table "{{questionnaire}}".
 *
 * The followings are the available columns in table '{{questionnaire}}':
 * @property integer $id
 * @property string $name
 * @property integer $project_id
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property QuestionnaireQuestion[] $questionnaireQuestions
 */
class Questionnaire extends CActiveRecord
{
	public static function getQuestionnaires($project_id) {
		$questionnaireCriteria = new CDbCriteria;
		$questionnaireCriteria->condition = "project_id=".$project_id;
		$questionnaireCriteria->limit = 3;
		return Questionnaire::Model()->findAll($questionnaireCriteria);
	}
	public static function getQuestionnairesCount($project_id) {
		$questionnaireCriteria = new CDbCriteria;
		$questionnaireCriteria->condition = "project_id=".$project_id;
		return Questionnaire::Model()->count($questionnaireCriteria);
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Questionnaire the static model class
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
		return '{{questionnaire}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('project_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, project_id', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'questionnaireQuestions' => array(self::HAS_MANY, 'QuestionnaireQuestion', 'questionnaire_id'),
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
			'project_id' => 'Project',
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
		$criteria->compare('project_id',$this->project_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}