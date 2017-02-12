<?php
/**
 * @var yii\web\View $this
 * @var app\models\User $modelUser
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = \Yii::t('app/library', 'Edit profile');
?>

<h1><?= $this->title; ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($modelUser, 'first_name')->textInput(); ?>
<?= $form->field($modelUser, 'last_name')->textInput(); ?>
<?= $form->field($modelUser, 'email')->textInput(); ?>

<div class="form-group">
    <?= Html::submitButton(\Yii::t('app/library', 'Update'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
