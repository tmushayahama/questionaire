<?php

/**
 * This is the model class for table "{{question}}".
 *
 * The followings are the available columns in table '{{question}}':
 * @property integer $id
 * @property string $sort_code
 * @property string $sort_name
 * @property string $tool
 * @property string $author
 * @property integer $year
 * @property string $concept
 * @property string $content
 *
 * The followings are the available model relations:
 * @property QuestionnaireQuestion[] $questionnaireQuestions
 * @property UserQuestion[] $userQuestions
 */
class Question extends CActiveRecord
{
	public $questionToolList;
	public $questionConceptList;
	public $questionYearList;
	
	public static function getUniqueTools() {
		/* 	$questionCriteria = new CDbCriteria();
		  //$questionCriteria->select = "tool";
		  $questionCriteria->condition = "user_id is null";
		  $questionCriteria->addCondition("tool=".$tool);
		  $questionCriteria->distinct = true; */
		return Question::model()->findAll(array(
								'select' => 't.tool',
								'group' => 't.tool',
								'distinct' => true,
		));
	}
	public static function getUniqueConcepts() {
		/* 	$questionCriteria = new CDbCriteria();
		  //$questionCriteria->select = "tool";
		  $questionCriteria->condition = "user_id is null";
		  $questionCriteria->addCondition("tool=".$tool);
		  $questionCriteria->distinct = true; */
		return Question::model()->findAll(array(
								'select' => 't.concept',
								'group' => 't.concept',
								'distinct' => true,
		));
	}
	public static function getUniqueYear() {
		return Question::model()->findAll(array(
								'select' => 't.year',
								'group' => 't.year',
								'distinct' => true,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Question the static model class
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
		return '{{question}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year', 'numerical', 'integerOnly'=>true),
			array('sort_code', 'length', 'max'=>10),
			array('sort_name, tool, author, concept', 'length', 'max'=>150),
			array('content', 'length', 'max'=>528),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sort_code, sort_name, tool, author, year, concept, content', 'safe', 'on'=>'search'),
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
			'questionnaireQuestions' => array(self::HAS_MANY, 'QuestionnaireQuestion', 'question_id'),
			'userQuestions' => array(self::HAS_MANY, 'UserQuestion', 'question_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sort_code' => 'Sort Code',
			'sort_name' => 'Sort Name',
			'tool' => 'Tool',
			'author' => 'Author',
			'year' => 'Year',
			'concept' => 'Concept',
			'content' => 'Content',
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
		$criteria->compare('sort_code',$this->sort_code,true);
		$criteria->compare('sort_name',$this->sort_name,true);
		$criteria->compare('tool',$this->tool,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('concept',$this->concept,true);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}