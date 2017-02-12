<?php
/**
 * @var yii\web\View $this
 * @var app\models\Tag $modelTag
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Html;

$this->title = \Yii::t('app/library', 'CRUD Tags');
?>

<h2><?= \Yii::t('app/library', 'Tags'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
</p>

<hr>

<?= yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $modelTag,
    'columns' => [
        'id',
        'title',
        'alias',
        [
            'format' => 'html',
            'label' => \Yii::t('app/library', 'Options'),
            'value' => function (app\models\Tag $modelTag) {
                return
                    Html::a(\Yii::t('app/library', 'View'), ['view', 'id' => $modelTag->id], ['class' => 'btn btn-default']) . ' ' .
                    Html::a(\Yii::t('app/library', 'Update'), ['update', 'id' => $modelTag->id], ['class' => 'btn btn-default']) . ' ' .
                    Html::a(\Yii::t('app/library', 'Delete'), ['delete', 'id' => $modelTag->id], ['class' => 'btn btn-danger']);
            },
        ]
    ],
]);
?>
