<?php
/**
 * @var yii\web\View $this
 * @var app\models\Tag $modelTag
 * @var yii\widgets\ActiveForm $form
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($modelTag, 'title')->textInput(); ?>
<?= $form->field($modelTag, 'alias')->textInput(); ?>

<div class="form-group">
    <?= Html::submitButton($modelTag->getIsNewRecord() ? \Yii::t('app/library', 'Create') :  \Yii::t('app/library', 'Update'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
