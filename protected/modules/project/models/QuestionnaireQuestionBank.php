<?php

/**
 * This is the model class for table "{{questionnaire_question_bank}}".
 *
 * The followings are the available columns in table '{{questionnaire_question_bank}}':
 * @property integer $id
 * @property integer $bank_questionnaire_id
 * @property integer $question_id
 *
 * The followings are the available model relations:
 * @property Questionnaire $bankQuestionnaire
 * @property QuestionBank $question
 */
class QuestionnaireQuestionBank extends CActiveRecord {

  public static function keywordSearch($keyword, $limit) {
    $keywordSearchCriteria = new CDbCriteria;
    $keywordSearchCriteria->with = array("question" => array("alias" => "qB"));
    $keywordSearchCriteria->compare("qB.tool", $keyword, true, "OR");
    $keywordSearchCriteria->compare("qB.concept", $keyword, true, "OR");
    $keywordSearchCriteria->compare("qB.author", $keyword, true, "OR");
    $keywordSearchCriteria->compare("qB.year", $keyword, true, "OR");
    $keywordSearchCriteria->compare("qB.content", $keyword, true, "OR");
    $keywordSearchCriteria->limit = $limit;
    return QuestionnaireQuestionBank::Model()->findAll($keywordSearchCriteria);
  }

  public static function getQuestionnaireQuestions($questionnaireId) {
    $questionnaireCriteria = new CDbCriteria;
    $questionnaireCriteria->addCondition("bank_questionnaire_id=" . $questionnaireId);
    $questionnaireCriteria->order = "question_id asc";
    return QuestionnaireQuestionBank::Model()->findAll($questionnaireCriteria);
  }

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return QuestionnaireQuestionBank the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{questionnaire_question_bank}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
     array('bank_questionnaire_id, question_id', 'required'),
     array('bank_questionnaire_id, question_id', 'numerical', 'integerOnly' => true),
     // The following rule is used by search().
     // Please remove those attributes that should not be searched.
     array('id, bank_questionnaire_id, question_id', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
     'bankQuestionnaire' => array(self::BELONGS_TO, 'Questionnaire', 'bank_questionnaire_id'),
     'question' => array(self::BELONGS_TO, 'QuestionBank', 'question_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
     'id' => 'ID',
     'bank_questionnaire_id' => 'Bank Questionnaire',
     'question_id' => 'Question',
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
    $criteria->compare('bank_questionnaire_id', $this->bank_questionnaire_id);
    $criteria->compare('question_id', $this->question_id);

    return new CActiveDataProvider($this, array(
     'criteria' => $criteria,
    ));
  }

}
