<?php
/**
 * @var yii\web\View $this
 * @var app\models\forms\LoginForm $modelLoginForm
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = \Yii::t('app/library', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title); ?></h1>

    <p><?= \Yii::t('app/library', 'Login form'); ?></p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($modelLoginForm, 'email')->textInput(['autofocus' => true]); ?>

        <?= $form->field($modelLoginForm, 'password')->passwordInput(); ?>

        <?= $form->field($modelLoginForm, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]); ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton(\Yii::t('app/library', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>
                <?= Html::a(\Yii::t('app/library', 'Registration'), 'registration', ['class' => 'btn btn-default']); ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
