<?php
/**
 * @var yii\web\View $this
 * @var app\models\Tag $modelTag
 */

$this->title = \Yii::t('app/library', 'CRUD Tags');
?>

<h2><?= \Yii::t('app/library', 'Tag info'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['index']); ?>"><?= \Yii::t('app/library', 'Tags'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['update', 'id' => $modelTag->id]); ?>"><?= \Yii::t('app/library', 'Update'); ?></a>
</p>

<?= yii\widgets\DetailView::widget([
    'model' => $modelTag,
    'attributes' => [
        'id',
        'title',
        'alias',
    ],
]);
?>
