<?php

/**
 * This is the model class for table "{{questionnaire_question}}".
 *
 * The followings are the available columns in table '{{questionnaire_question}}':
 * @property integer $id
 * @property integer $questionnaire_id
 * @property integer $question_id
 *
 * The followings are the available model relations:
 * @property UserQuestion $question
 * @property Questionnaire $questionnaire
 */
class QuestionnaireQuestion extends CActiveRecord {

	public static function getUserQuestions($questionnaireId) {
		$questionnaireQuestionCriteria = new CDbCriteria;
		//$questionnaireQuestionCriteria->condition = "user_id=" . Yii::app()->user->id;
		$questionnaireQuestionCriteria->addCondition("questionnaire_id=" . $questionnaireId);
		return QuestionnaireQuestion::Model()->findAll($questionnaireQuestionCriteria);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuestionnaireQuestion the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{questionnaire_question}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('questionnaire_id, question_id', 'required'),
				array('questionnaire_id, question_id', 'numerical', 'integerOnly' => true),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, questionnaire_id, question_id', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'question' => array(self::BELONGS_TO, 'UserQuestion', 'question_id'),
				'questionnaire' => array(self::BELONGS_TO, 'Questionnaire', 'questionnaire_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
				'id' => 'ID',
				'questionnaire_id' => 'Questionnaire',
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
		$criteria->compare('questionnaire_id', $this->questionnaire_id);
		$criteria->compare('question_id', $this->question_id);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
		));
	}

}