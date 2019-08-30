<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 29.08.2019
 * Time: 15:58
 */

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->secondname . ' ' . $model->firstname . ' ' . $model->lastname;

?>

<h1><?= $title ?></h1>

<?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
]); ?>

<?= $form->field($model, 'firstname')->widget(MultipleInput::className(), [
    'rendererClass' => \unclead\multipleinput\renderers\ListRenderer::class,
    'data' => $education,
    'model' => $educationModel,
    'layoutConfig' => [
        'offsetClass' => 'col-md-offset-2',
        'labelClass' => 'col-md-2',
        'wrapperClass' => 'col-md-10',
        'errorClass' => 'col-md-offset-2 col-md-6',
        'buttonActionClass' => 'col-md-offset-1 col-md-2',
    ],
    'columns' => [
        [
            'name'  => 'name',
            'title' => Yii::t('app','the name of the institution'),
        ],
        [
            'name'  => 'specialty',
            'title' => $educationModel->getAttributeLabel('specialty'),
        ],
        [
            'name'  => 'beginning_date',
            'title' => $educationModel->getAttributeLabel('beginning_date'),
            'type'  => \kartik\date\DatePicker::class,
            'options' => [
                'pluginOptions' => [
                    'format' => 'dd.mm.yyyy',
                    'todayHighlight' => true
                ]
            ],
        ],
        [
            'name'  => 'ending_date',
            'title' => $educationModel->getAttributeLabel('ending_date'),
            'type'  => \kartik\date\DatePicker::class,
            'options' => [
                'pluginOptions' => [
                    'format' => 'dd.mm.yyyy',
                    'todayHighlight' => true
                ]
            ],
        ],
        [
            'name'  => 'type',
            'defaultValue' => \app\models\Experience::TYPE_WORK,
            'options' => [
                'class' => 'hidden',
            ],
        ],
    ],
]); ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
