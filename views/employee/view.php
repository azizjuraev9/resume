<?php

use app\assets\ResumeAsset;
use app\enums\Nations;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Spaceless;

/* @var $this yii\web\View */
/* @var $model app\models\Employees */
/* @var $works \app\models\Experience[] */
/* @var $education \app\models\Experience[] */

$this->title = $model->secondname . ' ' . $model->firstname . ' ' . $model->lastname;
ResumeAsset::register($this);

Spaceless::begin();
?>
<div class="resume-view row">

    <div class="col-xs-12 resume-header">
        <div class="row resume-view">
            <div class="col-xs-2">
                <img src="<?= $model->photo ?>" class="img-responsive img-thumbnail" alt="No Photo">
            </div>
            <div class="col-xs-7">
                <h1><?= Html::encode($this->title) ?></h1>
                <p>
                    <b><?= Yii::t('app','Nation') ?>: </b>
                    <?= Nations::getItem($model->nation)[0]; ?>
                    ,
                    <b><?= Yii::t('app','Birth date') ?>: </b>
                    <?= $model->birth_date ?>
                </p>
                <p>
                    <b><?= Yii::t('app','Contacts') ?>: </b>
                    <span>
                        <?= $model->email ?> , <?= $model->phone ?>
                    </span>
                </p>
            </div>
            <div class="col-sm-3">
                <img src="<?= $model->qr ?>" class="img-responsive img-thumbnail pull-right" alt="No Photo">
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <h2 class="page-header">
        <span class="glyphicon glyphicon-briefcase"></span>
        <?= Yii::t('app','Work experience') ?>
    </h2>

    <div class="clearfix"></div>

    <?php foreach ($works as $work): ?>
        <div class="col-xs-12 experience">
            <div class="row">
                <div class="col-xs-3">
                    <h4>
                        <?= $work->beginning_date ?>
                        -
                        <?= $work->ending_date ?>
                    </h4>
                </div>
                <div class="col-sm-9">
                    <h3>
                        <?= $work->name ?>
                        <br>
                        <small><?= $work->specialty ?></small>
                    </h3>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="clearfix"></div>

    <h2 class="page-header">
        <span class="glyphicon glyphicon-education"></span>
        <?= Yii::t('app','Education') ?>
    </h2>

    <div class="clearfix"></div>

    <?php foreach ($education as $work): ?>
        <div class="col-xs-12 experience">
            <div class="row">
                <div class="col-xs-3">
                    <h4>
                        <?= $work->beginning_date ?>
                        -
                        <?= $work->ending_date ?>
                    </h4>
                </div>
                <div class="col-sm-9">
                    <h3>
                        <?= $work->name ?>
                        <br>
                        <small><?= $work->specialty ?></small>
                    </h3>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<?php Spaceless::end(); ?>