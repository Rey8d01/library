<?php
/**
 * @var yii\web\View $this
 * @var app\models\Book $modelBook
 */

$this->title = \Yii::t('app/library', 'CRUD Books');
?>

<h2><?= \Yii::t('app/library', 'New book'); ?></h2>

<?= $this->render('_form', ['modelBook' => $modelBook]); ?>
