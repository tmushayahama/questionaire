<?php

/**
 * This is the model class for table "{{project}}".
 *
 * The followings are the available columns in table '{{project}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property ProjectQuestionnaire[] $projectQuestionnaires
 * @property UserProject[] $userProjects
 */
class Project extends CActiveRecord {

  public static $PROJECT_STATUS_PLAYGROUND = -2;

  /** This is the initialization of a project after a user 
   * has registered. It creates a playground prject and a number of questionnaires.
   * 
   */
  public static function initProject($userId) {
    $project = new Project();
    $project->name = "Playground Tour";
    $project->description = "This is a test project to help you get used to Questionnaire.";
    $project->status = Project::$PROJECT_STATUS_PLAYGROUND;
    if ($project->save(false)) {
      $userProject = new UserProject;
      $userProject->project_id = $project->id;
      $userProject->user_id = $userId;
      if ($userProject->save(false)) {
       self::createPlaygroundQuestionnaire($project->id);
      }
    }
  }

  private static function createPlaygroundQuestionnaire($projectId) {
    for ($i = 1; $i < 4; $i++) {
      $questionnaire = new Questionnaire();
      $questionnaire->name = "Test Questionnaire " . $i;
      $questionnaire->status = Questionnaire::$QUESTIONNAIRE_STATUS_PLAYGROUND;
      if ($questionnaire->save(false)) {
        $projectQuestionnaire = new ProjectQuestionnaire();
        $projectQuestionnaire->user_questionnaire_id = $questionnaire->id;
        $projectQuestionnaire->project_id = $projectId;
        $projectQuestionnaire->save(false);
      }
    }
  }
  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Project the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{project}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
    return array(
     array('name', 'required'),
     array('name', 'length', 'max' => 150),
     array('description', 'length', 'max' => 500),
     // The following rule is used by search().
// Please remove those attributes that should not be searched.
     array('id, name, description', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
    return array(
     'projectQuestionnaires' => array(self::HAS_MANY, 'ProjectQuestionnaire', 'project_id'),
     'userProjects' => array(self::HAS_MANY, 'UserProject', 'project_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
     'id' => 'ID',
     'name' => 'Name',
     'description' => 'Description',
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
    $criteria->compare('description', $this->description, true);

    return new CActiveDataProvider($this, array(
     'criteria' => $criteria,
    ));
  }

}
