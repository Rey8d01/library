<?php
/**
 * @var yii\web\View $this
 * @var app\models\BookAtUser $modelBookAtUser
 */

$this->title = \Yii::t('app/library', 'CRUD Book at user');
?>

<h2><?= \Yii::t('app/library', 'Editing book info'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['view', 'id' => $modelBookAtUser->id]); ?>"><?= \Yii::t('app/library', 'Book at user info'); ?></a>
</p>

<?= $this->render('_form', ['modelBookAtUser' => $modelBookAtUser]); ?>
