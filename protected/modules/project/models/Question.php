<?php

/**
 * This is the model class for table "{{question}}".
 *
 * The followings are the available columns in table '{{question}}':
 * @property integer $id
 * @property string $code
 * @property string $tool
 * @property string $author
 * @property string $year
 * @property string $concept
 * @property string $content
 * @property integer $number
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property QuestionnaireQuestion[] $questionnaireQuestions
 */
class Question extends CActiveRecord
{
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
			array('number, status', 'numerical', 'integerOnly'=>true),
			array('code, tool, author, concept, content', 'length', 'max'=>150),
			array('year', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, tool, author, year, concept, content, number, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'tool' => 'Tool',
			'author' => 'Author',
			'year' => 'Year',
			'concept' => 'Concept',
			'content' => 'Content',
			'number' => 'Number',
			'status' => 'Status',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('tool',$this->tool,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('concept',$this->concept,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}