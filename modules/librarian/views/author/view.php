<?php
/**
 * @var yii\web\View $this
 * @var app\models\Author $modelAuthor
 */

$this->title = \Yii::t('app/library', 'CRUD Authors');
?>

<h2><?= \Yii::t('app/library', 'Author info'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['update', 'id' => $modelAuthor->id]); ?>"><?= \Yii::t('app/library', 'Update'); ?></a>
</p>

<?= yii\widgets\DetailView::widget([
    'model' => $modelAuthor,
    'attributes' => [
        'id',
        'name',
        'description',
        'photo',
    ],
]);
?>
