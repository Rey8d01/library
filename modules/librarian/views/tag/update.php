<?php
/**
 * @var yii\web\View $this
 * @var app\models\Tag $modelTag
 */

$this->title = \Yii::t('app/library', 'CRUD Tags');
?>

<h2><?= \Yii::t('app/library', 'Editing tag info'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['index']); ?>"><?= \Yii::t('app/library', 'Tags'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
</p>

<?= $this->render('_form', ['modelTag' => $modelTag]); ?>
