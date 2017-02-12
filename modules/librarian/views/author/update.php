<?php
/**
 * @var yii\web\View $this
 * @var app\models\Author $modelAuthor
 */

$this->title = \Yii::t('app/library', 'CRUD Authors');
?>

<h2><?= \Yii::t('app/library', 'Editing author info'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
</p>

<?= $this->render('_form', ['modelAuthor' => $modelAuthor]); ?>
