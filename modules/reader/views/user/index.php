<?php
/**
 * @var yii\web\View $this
 * @var app\models\User $modelUser
 * @var yii\data\ActiveDataProvider $dataProviderBookAtUserActual
 * @var yii\data\ActiveDataProvider $dataProviderBookAtUserOverdue
 */

use yii\helpers\Html;

$columnsGridViewForBookAtUser = [
    'id',
    [
        'attribute' => 'book_id',
        'format' => 'html',
        'value' => function (app\models\BookAtUser $modelBookAtUser) {
            return Html::a($modelBookAtUser->book->title, ['/catalog/view', 'alias' => $modelBookAtUser->book->alias]);
        },
    ],
    'limit_date',
    'receipt_date',
];

$this->title = \Yii::t('app/library', 'Profile');
?>

<h1><?= $this->title; ?></h1>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['update']); ?>"><?= \Yii::t('app/library', 'Update'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['message/index']); ?>"><?= \Yii::t('app/library', 'Messages to librarian'); ?></a>
</p>

<?= yii\widgets\DetailView::widget([
    'model' => $modelUser,
    'attributes' => [
        'id',
        'first_name',
        'last_name',
        'email',
    ],
]);
?>

<div class="row">
    <div class="col-md-6">
        <h4><?= \Yii::t('app/library', 'Your books'); ?></h4>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderBookAtUserActual,
            'columns' => $columnsGridViewForBookAtUser,
        ]);
        ?>
    </div>
    <div class="col-md-6">
        <h4><?= \Yii::t('app/library', 'Your overdue books'); ?></h4>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderBookAtUserOverdue,
            'columns' => $columnsGridViewForBookAtUser,
        ]);
        ?>
    </div>
</div>
