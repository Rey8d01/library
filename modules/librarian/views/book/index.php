<?php
/**
 * @var yii\web\View $this
 * @var app\models\Book $modelBook
 * @var yii\data\ActiveDataProvider $dataProviderBook
 */

use yii\helpers\Html;

$this->title = \Yii::t('app/library', 'CRUD Books');
?>

<h2><?= \Yii::t('app/library', 'Books'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['index']); ?>"><?= \Yii::t('app/library', 'All'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['list-available-books']); ?>"><?= \Yii::t('app/library', 'Available books'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
</p>

<hr>

<?= yii\grid\GridView::widget([
    'dataProvider' => $dataProviderBook,
    'filterModel' => $modelBook,
    'columns' => [
        'id',
        'title',
        'copies',
        'alias',
        [
            'attribute' => 'description',
            'value' => function (app\models\Book $modelBook) {
                return \yii\helpers\BaseStringHelper::truncateWords($modelBook->description, 10);
            },
        ],
        [
            'attribute' => 'photo',
            'format' => 'html',
            'value' => function (app\models\Book $modelBook) {
                return $modelBook->photo ? Html::img($modelBook->photo) : '';
            },
        ],
        [
            'format' => 'html',
            'label' => \Yii::t('app/library', 'Options'),
            'value' => function (app\models\Book $modelBook) {
                return
                    Html::a(\Yii::t('app/library', 'View'), ['view', 'id' => $modelBook->id], ['class' => 'btn btn-default']) . ' ' .
                    Html::a(\Yii::t('app/library', 'Update'), ['update', 'id' => $modelBook->id], ['class' => 'btn btn-default']) . ' ' .
                    Html::a(\Yii::t('app/library', 'Delete'), ['delete', 'id' => $modelBook->id], ['class' => 'btn btn-danger']);
            },
        ]
    ],
]);
?>
