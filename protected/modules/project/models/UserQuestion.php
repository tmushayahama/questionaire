<?php

/**
 * This is the model class for table "{{user_question}}".
 *
 * The followings are the available columns in table '{{user_question}}':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $questionnaire_id
 * @property string $content
 * @property integer $scale
 * @property string $answer
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Questionnaire $questionnaire
 * @property QuestionBank $parent
 */
class UserQuestion extends CActiveRecord {

  public static $FROM_QUESTION = 0;
  public static $FROM_QUESTION_MODIFIED = 1;
  public static $FROM_QUESTIONNAIRE = 2;
  public static $FROM_QUESTIONNAIRE_MODIFIED = 3;
  public static $NEW_QUESTION = 4;

  public static function getUserQuestions($questionnaireId) {
    $userQuestionCriteria = new CDbCriteria;
    //$questionnaireQuestionCriteria->condition = "user_id=" . Yii::app()->user->id;
    $userQuestionCriteria->order = "id desc";
    $userQuestionCriteria->addCondition("questionnaire_id=" . $questionnaireId);
    return UserQuestion::Model()->findAll($userQuestionCriteria);
  }
   public static function getUserQuestionsCount($questionnaireId) {
    $userQuestionCriteria = new CDbCriteria;
    //$questionnaireQuestionCriteria->condition = "user_id=" . Yii::app()->user->id;

    $userQuestionCriteria->addCondition("questionnaire_id=" . $questionnaireId);
    return UserQuestion::Model()->count($userQuestionCriteria);
  }
  public static function getUserQuestionsOriginalCount($questionnaireId) {
    $userQuestionCriteria = new CDbCriteria;
    //$questionnaireQuestionCriteria->condition = "user_id=" . Yii::app()->user->id;

    $userQuestionCriteria->addCondition("questionnaire_id=" . $questionnaireId);
    $userQuestionCriteria->addCondition("status=" . UserQuestion::$FROM_QUESTION. " OR status=".UserQuestion::$FROM_QUESTIONNAIRE);
  return UserQuestion::Model()->count($userQuestionCriteria);
  }
  public static function getUserQuestionsModifiedCount($questionnaireId) {
    $userQuestionCriteria = new CDbCriteria;
    //$questionnaireQuestionCriteria->condition = "user_id=" . Yii::app()->user->id;

    $userQuestionCriteria->addCondition("questionnaire_id=" . $questionnaireId);
    $userQuestionCriteria->addCondition("status=" . UserQuestion::$FROM_QUESTION_MODIFIED. " OR status=".UserQuestion::$FROM_QUESTIONNAIRE_MODIFIED);
    return UserQuestion::Model()->count($userQuestionCriteria);
  }
   public static function getUserQuestionsCreatedCount($questionnaireId) {
    $userQuestionCriteria = new CDbCriteria;
    //$questionnaireQuestionCriteria->condition = "user_id=" . Yii::app()->user->id;

    $userQuestionCriteria->addCondition("questionnaire_id=" . $questionnaireId);
    $userQuestionCriteria->addCondition("status=" . UserQuestion::$NEW_QUESTION);
  
    return UserQuestion::Model()->count($userQuestionCriteria);
  }

  public static function getModified($questionId) {
    $criteria = new CDbCriteria;
    $criteria->condition = 'question_id=' . $questionId;
    return UserQuestion::Model()->count($criteria);
  }

  public static function isAdded($questionId, $questionnaireId) {
    $criteria = new CDbCriteria;
    //$parentId = QuestionBank::Model()->findByPk($questionId);
    //$criteria->condition = "user_id=" . Yii::app()->user->id;
    $criteria->addCondition('parent_id=' . $questionId);
    $criteria->addCondition('questionnaire_id=' . $questionnaireId);
    if (UserQuestion::Model()->count($criteria) == 0) {
      return false;
    }
    return true;
  }

  public static function getUserQuestionsByParentId($questionnaireId, $parentId) {
    $userQuestionCriteria = new CDbCriteria;
    $userQuestionCriteria->order = "id desc";
    $userQuestionCriteria->addCondition("questionnaire_id=" . $questionnaireId);
    $userQuestionCriteria->addCondition("parent_id=" . $parentId);
    return UserQuestion::Model()->findAll($userQuestionCriteria);
  }

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return UserQuestion the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{user_question}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
     array('questionnaire_id', 'required'),
     array('parent_id, questionnaire_id, scale, status', 'numerical', 'integerOnly' => true),
     array('content', 'length', 'max' => 528),
     array('answer', 'length', 'max' => 500),
     // The following rule is used by search().
     // Please remove those attributes that should not be searched.
     array('id, parent_id, questionnaire_id, content, scale, answer, status', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
     'questionnaire' => array(self::BELONGS_TO, 'Questionnaire', 'questionnaire_id'),
     'parent' => array(self::BELONGS_TO, 'QuestionBank', 'parent_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
     'id' => 'ID',
     'parent_id' => 'Parent',
     'questionnaire_id' => 'Questionnaire',
     'content' => 'Content',
     'scale' => 'Scale',
     'answer' => 'Answer',
     'status' => 'Status',
    );
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search() {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria = new CDbCriteria;

    $criteria->compare('id', $this->id);
    $criteria->compare('parent_id', $this->parent_id);
    $criteria->compare('questionnaire_id', $this->questionnaire_id);
    $criteria->compare('content', $this->content, true);
    $criteria->compare('scale', $this->scale);
    $criteria->compare('answer', $this->answer, true);
    $criteria->compare('status', $this->status);

    return new CActiveDataProvider($this, array(
     'criteria' => $criteria,
    ));
  }

}
