<?php
/**
 * @var yii\web\View $this
 * @var app\models\Book $modelBook
 */

$this->title = \Yii::t('app/library', 'CRUD Books');
?>

<h2><?= \Yii::t('app/library', 'Editing book info'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
</p>

<?= $this->render('_form', ['modelBook' => $modelBook]); ?>
