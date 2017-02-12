<?php
/**
 * @var yii\web\View $this
 * @var app\models\BookAtUser $modelBookAtUser
 */

$this->title = \Yii::t('app/library', 'CRUD Book at user');
?>

<h2><?= \Yii::t('app/library', 'New book at user'); ?></h2>

<?= $this->render('_form', ['modelBookAtUser' => $modelBookAtUser]); ?>
