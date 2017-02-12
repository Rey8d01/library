<?php
/**
 * @var yii\web\View $this
 * @var app\models\BookAtUser $modelBookAtUser
 * @var yii\widgets\ActiveForm $form
 */

use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($modelBookAtUser, 'book_id')->textInput(); ?>
<?= $form->field($modelBookAtUser, 'user_id')->textInput(); ?>

<?= $form->field($modelBookAtUser, 'limit_date')->widget(
    DatePicker::class,
    [
        'dateFormat' => 'yyyy.MM.dd',
        'options' => [
            'class' => 'form-control'
        ]
    ]
);
?>

<?= $form->field($modelBookAtUser, 'receipt_date')->widget(
    DatePicker::class,
    [
        'dateFormat' => 'yyyy.MM.dd',
        'options' => [
            'class' => 'form-control',
        ]
    ]
);
?>

<div class="form-group">
    <?= Html::submitButton($modelBookAtUser->getIsNewRecord() ?  \Yii::t('app/library', 'Create') :  \Yii::t('app/library', 'Update'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
