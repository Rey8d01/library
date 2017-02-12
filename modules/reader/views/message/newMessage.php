<?php
/**
 * @var yii\web\View $this
 * @var app\models\User $modelUser
 * @var app\modules\reader\models\forms\MessageForm $modelMessageForm
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app/library', 'New message');
?>

<h1><?= $this->title; ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($modelMessageForm, 'textMessage')->textarea(); ?>

<div class="form-group">
    <?= Html::submitButton(\Yii::t('app/library', 'Send message'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
