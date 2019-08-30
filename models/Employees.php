<?php

namespace app\models;

use app\services\EmployeeService;
use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $firstname
 * @property string $secondname
 * @property string $lastname
 * @property string $birth_date
 * @property int $nation
 * @property string $phone
 * @property string $email
 * @property string $photo
 * @property string $qr
 *
 * @property Experience[] $experiences
 */
class Employees extends \yii\db\ActiveRecord
{

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'secondname', 'lastname', 'birth_date', 'nation', 'phone', 'email'], 'required'],
            [['birth_date'], 'safe'],
            [['email'], 'email'],
            [['phone'], 'match', 'pattern' => '/^(\+998 \d{2} \d{3}\-\d{2}\-\d{2})$/'],
            [['nation'], 'integer'],
            [['firstname', 'secondname', 'lastname', 'phone'], 'string', 'max' => 20],
            [['email', 'photo', 'qr'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'secondname' => Yii::t('app', 'Secondname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'nation' => Yii::t('app', 'Nation'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'image' => Yii::t('app', 'Image'),
            'photo' => Yii::t('app', 'Photo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        return $this->hasMany(Experience::className(), ['employee_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        EmployeeService::uploadImage($this);
        $this->birth_date = date("Y-m-d",strtotime($this->birth_date));
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->birth_date = date("d.m.Y",strtotime($this->birth_date));
        parent::afterFind();
    }

    public function beforeDelete()
    {
        EmployeeService::deletePhoto($this);
        EmployeeService::deleteQr($this);
        return parent::beforeDelete();
    }
}
