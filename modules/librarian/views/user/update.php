<?php
/**
 * @var yii\web\View $this
 * @var app\models\User $modelUser
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = \Yii::t('app/library', 'CRUD Users');
?>

<h2><?= \Yii::t('app/library', 'Editing tag info'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['view', 'id' => $modelUser->id]); ?>"><?= \Yii::t('app/library', 'User info'); ?></a>
</p>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($modelUser, 'first_name')->textInput(); ?>
<?= $form->field($modelUser, 'last_name')->textInput(); ?>
<?= $form->field($modelUser, 'email')->textInput(); ?>

<div class="form-group">
    <?= Html::submitButton(\Yii::t('app/library', 'Update'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
