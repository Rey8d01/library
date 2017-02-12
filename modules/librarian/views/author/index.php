<?php
/**
 * @var yii\web\View $this
 * @var app\models\Author $modelAuthor
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Html;

$this->title = \Yii::t('app/library', 'CRUD Authors');
?>

<h2><?= \Yii::t('app/library', 'Authors'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
</p>

<hr>

<?= yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $modelAuthor,
    'columns' => [
        'id',
        'name',
        [
            'attribute' => 'description',
            'value' => function (app\models\Author $modelAuthor) {
                return \yii\helpers\BaseStringHelper::truncateWords($modelAuthor->description, 10);
            },
        ],
        [
            'attribute' => 'photo',
            'format' => 'html',
            'value' => function (app\models\Author $modelAuthor) {
                return $modelAuthor->photo ? Html::img($modelAuthor->photo) : '';
            },
        ],
        [
            'format' => 'html',
            'label' => \Yii::t('app/library', 'Options'),
            'value' => function (app\models\Author $modelAuthor) {
                return
                    Html::a(\Yii::t('app/library', 'View'), ['author/view', 'id' => $modelAuthor->id], ['class' => 'btn btn-default']) . ' ' .
                    Html::a(\Yii::t('app/library', 'Update'), ['author/update', 'id' => $modelAuthor->id], ['class' => 'btn btn-default']) . ' ' .
                    Html::a(\Yii::t('app/library', 'Delete'), ['author/delete', 'id' => $modelAuthor->id], ['class' => 'btn btn-danger']);
            },
        ]
    ],
]);
?>
