<?php

use app\enums\Nations;
use buttflattery\formwizard\FormWizard;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Employees */

$this->title = Yii::t('app', 'Create Employees');
?>
<div class="employees-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= FormWizard::widget([
        'theme' => FormWizard::THEME_ARROWS,
        'labelNext' => Yii::t('app', 'Next'),
        'labelPrev' => Yii::t('app', 'Previous'),
        'labelFinish' => Yii::t('app', 'Finish'),
        'formOptions'=>[
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
        ],
        'steps' => [
            [
                'model' => $model,
                'title' => Yii::t('app','Personal Info'),
                'description' => Yii::t('app','Add personal Info'),
                'formInfoText' => false,
                'fieldOrder'=>['image','firstname', 'secondname', 'lastname', 'birth_date', 'nation', 'phone', 'email',],
                'fieldConfig' => [
                    'qr' => false,
                    'photo' => false,
                    'image' => [
                        'options' => [
                            'type' => 'file',
                            'options' => ['accept' => 'image/*'],
                        ],
                    ],
                    'birth_date' => [
                        'widget' => DatePicker::class,
                        'options' => [
                            'pluginOptions' => [
                                'format' => 'dd.mm.yyyy',
                                'todayHighlight' => true
                            ]
                        ],
                    ],
                    'nation' => [
                        'options' => [
                            'type' => 'dropdown',
                            'itemsList' => Nations::getList(),
                        ]
                    ],
                    'phone' => [
                        'widget' => MaskedInput::class,
                        'options' => [
                            'mask' => '+\9\98 99 999-99-99',
                        ],
                    ],
                ]
            ],
            [
                'model' => $experience,
                'title' => Yii::t('app','Education'),
                'description' => Yii::t('app','Add education info'),
                'formInfoText' => Yii::t('app','Click (+) button to add new item'),
                'fieldConfig' => [
                    'employee_id' => false,
                    'specialty' => false,
                    'beginning_date' => false,
                    'ending_date' => false,
                    'type' => false,
                    'name' => [
                        'widget' => MultipleInput::class,
                        'labelOptions' => [
                            'label' => false
                        ],
                        'options' => [
                            'min' => 0,
//                            'allowEmptyList' => true,
                            'rendererClass' => \unclead\multipleinput\renderers\ListRenderer::class,
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
                                    'title' => Yii::t('app','The name of the institution'),
                                ],
                                [
                                    'name'  => 'specialty',
                                    'title' => $experience->getAttributeLabel('specialty'),
                                ],
                                [
                                    'name'  => 'beginning_date',
                                    'title' => $experience->getAttributeLabel('beginning_date'),
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
                                    'title' => $experience->getAttributeLabel('ending_date'),
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
                                    'defaultValue' => \app\models\Experience::TYPE_EDUCATION,
                                    'options' => [
                                        'class' => 'hidden',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
            ],
            [
                'model' => $experience,
                'title' => Yii::t('app','Work experience'),
                'description' => Yii::t('app','Add work experience info'),
                'formInfoText' => Yii::t('app','Click (+) button to add new item'),
                'fieldConfig' => [
                    'employee_id' => false,
                    'name' => false,
                    'beginning_date' => false,
                    'ending_date' => false,
                    'type' => false,
                    'specialty' => [
                        'widget' => MultipleInput::class,
                        'labelOptions' => [
                            'label' => ''
                        ],
                        'options' => [
                            'min' => 0,
//                            'allowEmptyList' => true,
                            'rendererClass' => \unclead\multipleinput\renderers\ListRenderer::class,
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
                                    'title' => Yii::t('app','The name of the workplace'),
                                ],
                                [
                                    'name'  => 'specialty',
                                    'title' => $experience->getAttributeLabel('specialty'),
                                ],
                                [
                                    'name'  => 'beginning_date',
                                    'title' => $experience->getAttributeLabel('beginning_date'),
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
                                    'title' => $experience->getAttributeLabel('ending_date'),
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
                        ],
                    ],
                ]
            ],
        ]
    ]) ?>

</div>
