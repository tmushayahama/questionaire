<?php

/**
 * This is the model class for table "{{questionnaire}}".
 *
 * The followings are the available columns in table '{{questionnaire}}':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property ProjectQuestionnaire[] $projectQuestionnaires
 * @property Questionnaire $parent
 * @property Questionnaire[] $questionnaires
 * @property QuestionnaireQuestionBank[] $questionnaireQuestionBanks
 * @property UserQuestion[] $userQuestions
 */
class Questionnaire extends CActiveRecord {

  public static $QUESTIONNAIRE_STATUS_PLAYGROUND = -2;
  public $questionnaireSelected;

  public static function initQuestionnaire() {
    $questionCriteria = new CDbCriteria;
    $questionCriteria->group = "tool";
    $questionCriteria->distinct = "tool";
    $questions = QuestionBank::Model()->findAll($questionCriteria);
    foreach ($questions as $question) {
      $questionnaire = new Questionnaire;
      $questionnaire->name = $question->tool;
      if ($questionnaire->save(false)) {
        $questionnaireQuestionBankCriteria = new CDbCriteria;
        $questionnaireQuestionBankCriteria->addCondition('tool="' . $questionnaire->name . '"');
        $questionnaireQuestions = QuestionBank::Model()->findAll($questionnaireQuestionBankCriteria);
        foreach ($questionnaireQuestions as $questionnaireQuestion) {
          $questionnaireQuestionBank = new QuestionnaireQuestionBank;
          $questionnaireQuestionBank->bank_questionnaire_id = $questionnaire->id;
          $questionnaireQuestionBank->question_id = $questionnaireQuestion->id;
          $questionnaireQuestionBank->save(false);
        }
      }
    }
  }

  public static function getQuestionnaires() {
    $questionnaireCriteria = new CDbCriteria;
    $questionnaireCriteria->group = "name";
    $questionnaireCriteria->distinct = true;
    $questionnaireCriteria->addCondition("status=0");
    $questionnaireCriteria->order = "name asc";
    return Questionnaire::Model()->findAll($questionnaireCriteria);
  }

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Questionnaire the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{questionnaire}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
     array('name', 'required'),
     array('status, parent_id', 'numerical', 'integerOnly' => true),
     array('name', 'length', 'max' => 150),
     // The following rule is used by search().
     // Please remove those attributes that should not be searched.
     array('id, name, status, parent_id', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
     'projectQuestionnaires' => array(self::HAS_MANY, 'ProjectQuestionnaire', 'user_questionnaire_id'),
     'parent' => array(self::BELONGS_TO, 'Questionnaire', 'parent_id'),
     'questionnaires' => array(self::HAS_MANY, 'Questionnaire', 'parent_id'),
     'questionnaireQuestionBanks' => array(self::HAS_MANY, 'QuestionnaireQuestionBank', 'bank_questionnaire_id'),
     'userQuestions' => array(self::HAS_MANY, 'UserQuestion', 'questionnaire_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
     'id' => 'ID',
     'name' => 'Name',
     'status' => 'Status',
     'parent_id' => 'Parent',
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
    $criteria->compare('name', $this->name, true);
    $criteria->compare('status', $this->status);
    $criteria->compare('parent_id', $this->parent_id);

    return new CActiveDataProvider($this, array(
     'criteria' => $criteria,
    ));
  }

}
