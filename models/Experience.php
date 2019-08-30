<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "experience".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $name
 * @property string $specialty
 * @property string $beginning_date
 * @property string $ending_date
 * @property string $type
 *
 * @property Employees $employee
 */
class Experience extends \yii\db\ActiveRecord
{

    const TYPE_WORK = 'work';
    const TYPE_EDUCATION = 'education';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experience';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'name', 'specialty', 'beginning_date', 'ending_date', 'type'], 'required'],
            [['employee_id'], 'integer'],
            [['beginning_date', 'ending_date'], 'safe'],
            [['type'], 'string'],
            [['type'], 'in', 'range' => ['work','education']],
            [['name', 'specialty'], 'string', 'max' => 255],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'name' => Yii::t('app', 'Name'),
            'specialty' => Yii::t('app', 'Specialty'),
            'beginning_date' => Yii::t('app', 'Beginning Date'),
            'ending_date' => Yii::t('app', 'Ending Date'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employees::className(), ['id' => 'employee_id']);
    }

    public function beforeSave($insert)
    {
        $this->beginning_date = date("Y-m-d",strtotime($this->beginning_date));
        $this->ending_date = date("Y-m-d",strtotime($this->ending_date));
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->beginning_date = date("d.m.Y",strtotime($this->beginning_date));
        $this->ending_date = date("d.m.Y",strtotime($this->ending_date));
        parent::afterFind();
    }
}
