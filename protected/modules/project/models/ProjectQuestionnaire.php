<?php

/**
 * This is the model class for table "{{project_questionnaire}}".
 *
 * The followings are the available columns in table '{{project_questionnaire}}':
 * @property integer $id
 * @property integer $project_id
 * @property integer $user_questionnaire_id
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property Questionnaire $userQuestionnaire
 */
class ProjectQuestionnaire extends CActiveRecord {
  public static function getProjectQuestionnaires($project_id) {
    $projectQuestionnaireCriteria = new CDbCriteria;
    $projectQuestionnaireCriteria->condition = "project_id=" . $project_id;
    $projectQuestionnaireCriteria->limit = 3;
    return ProjectQuestionnaire::Model()->findAll($projectQuestionnaireCriteria);
  }
  
  public static function getProjectQuestionnairesCount($project_id) {
    $projectQestionnaireCriteria = new CDbCriteria;
    $projectQestionnaireCriteria->condition = "project_id=" . $project_id;
  return ProjectQuestionnaire::Model()->count($projectQestionnaireCriteria);
  }
   

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return ProjectQuestionnaire the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{project_questionnaire}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
     array('project_id, user_questionnaire_id', 'required'),
     array('project_id, user_questionnaire_id', 'numerical', 'integerOnly' => true),
     // The following rule is used by search().
     // Please remove those attributes that should not be searched.
     array('id, project_id, user_questionnaire_id', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
     'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
     'userQuestionnaire' => array(self::BELONGS_TO, 'Questionnaire', 'user_questionnaire_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
     'id' => 'ID',
     'project_id' => 'Project',
     'user_questionnaire_id' => 'User Questionnaire',
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
    $criteria->compare('project_id', $this->project_id);
    $criteria->compare('user_questionnaire_id', $this->user_questionnaire_id);

    return new CActiveDataProvider($this, array(
     'criteria' => $criteria,
    ));
  }

}
