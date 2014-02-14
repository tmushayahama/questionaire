<?php

/**
 * This is the model class for table "{{question_bank}}".
 *
 * The followings are the available columns in table '{{question_bank}}':
 * @property integer $id
 * @property string $sort_code
 * @property string $tool
 * @property string $author
 * @property integer $year
 * @property string $concept
 * @property string $content
 * @property integer $scale
 * @property string $answer
 * @property integer $times_added
 * @property integer $times_modified
 *
 * The followings are the available model relations:
 * @property QuestionnaireQuestionBank[] $questionnaireQuestionBanks
 * @property UserQuestion[] $userQuestions
 */
class QuestionBank extends CActiveRecord
{
  public static $FILTER_TOOL = 1;
  public static $FILTER_CONCEPT = 2;
  public static $FILTER_YEAR = 3;
  
  public $questionConceptList;
  public $questionYearList;

  public static function keywordSearch($keyword, $tool, $concept, $year, $limit) {
    $keywordSearchCriteria = self::keywordSearchCriteria($keyword, $tool, $concept, $year);
    $keywordSearchCriteria->limit = $limit;
    return QuestionBank::Model()->findAll($keywordSearchCriteria);
  }
  public static function keywordSearchCount($keyword, $tool, $concept, $year) {
    $keywordSearchCriteria = self::keywordSearchCriteria($keyword, $tool, $concept, $year);
    return QuestionBank::Model()->count($keywordSearchCriteria);
  }

  public static function keywordSearchCriteria($keyword, $tool, $concept, $year) {
    $keywordSearchCriteria = new CDbCriteria;
    $keywordSearchCriteria->compare("tool", $keyword, true, "OR");
    $keywordSearchCriteria->compare("concept", $keyword, true, "OR");
    $keywordSearchCriteria->compare("author", $keyword, true, "OR");
    $keywordSearchCriteria->compare("year", $keyword, true, "OR");
    $keywordSearchCriteria->compare("content", $keyword, true, "OR");
    if ($tool != null) {
      $keywordSearchCriteria->addCondition("tool='" . $tool . "'");
    }
    if ($concept != null) {
      $keywordSearchCriteria->addCondition("concept='" . $concept . "'");
    }
    if ($year != null) {
      $keywordSearchCriteria->addCondition("year=" . $year);
    }

    return $keywordSearchCriteria;
  }

  public static function getUniqueColumn($keyword, $tool, $concept, $year, $group) {
    $keywordSearchCriteria = self::keywordSearchCriteria($keyword, $tool, $concept, $year);
    $keywordSearchCriteria->group = $group;
    $keywordSearchCriteria->distinct = true;
    return QuestionBank::Model()->findAll($keywordSearchCriteria);
  }

  public static function getUniqueTools() {
    /* 	$questionCriteria = new CDbCriteria();
      //$questionCriteria->select = "tool";
      $questionCriteria->condition = "user_id is null";
      $questionCriteria->addCondition("tool=".$tool);
      $questionCriteria->distinct = true; */
    return QuestionBank::model()->findAll(array(
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
    return QuestionBank::model()->findAll(array(
       'select' => 't.concept',
       'group' => 't.concept',
       'distinct' => true,
    ));
  }

  public static function getUniqueYear() {
    return QuestionBank::model()->findAll(array(
       'select' => 't.year',
       'group' => 't.year',
       'distinct' => true,
    ));
  }

  public static function modifyTimesAdded($questionBankModel, $increment) {
    if ($increment) {
      $questionBankModel->times_added++;
    } else {
      if ($questionBankModel->times_added > 0) {
        $questionBankModel->times_added--;
      }
    }
    return $questionBankModel->save(false);
  }
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuestionBank the static model class
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
		return '{{question_bank}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year, scale, times_added, times_modified', 'numerical', 'integerOnly'=>true),
			array('sort_code, author, concept', 'length', 'max'=>150),
			array('tool', 'length', 'max'=>1000),
			array('content', 'length', 'max'=>528),
			array('answer', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sort_code, tool, author, year, concept, content, scale, answer, times_added, times_modified', 'safe', 'on'=>'search'),
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
			'questionnaireQuestionBanks' => array(self::HAS_MANY, 'QuestionnaireQuestionBank', 'question_id'),
			'userQuestions' => array(self::HAS_MANY, 'UserQuestion', 'parent_id'),
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
			'tool' => 'Tool',
			'author' => 'Author',
			'year' => 'Year',
			'concept' => 'Concept',
			'content' => 'Content',
			'scale' => 'Scale',
			'answer' => 'Answer',
			'times_added' => 'Times Added',
			'times_modified' => 'Times Modified',
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
		$criteria->compare('tool',$this->tool,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('concept',$this->concept,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('scale',$this->scale);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('times_added',$this->times_added);
		$criteria->compare('times_modified',$this->times_modified);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}