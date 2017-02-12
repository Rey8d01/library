<?php
/**
 * @var yii\web\View $this
 * @var app\models\User $modelUser
 * @var yii\data\ActiveDataProvider $dataProviderBookAtUserActual
 * @var yii\data\ActiveDataProvider $dataProviderBookAtUserOverdue
 * @var yii\data\ActiveDataProvider $dataProviderMessage
 */

use yii\helpers\Html;

$columnsGridViewForBookAtUser = [
    'id',
    [
        'attribute' => 'book_id',
        'format' => 'html',
        'value' => function (app\models\BookAtUser $modelBookAtUser) {
            return Html::a($modelBookAtUser->book->title, ['book/view', 'id' => $modelBookAtUser->book_id]);
        },
    ],
    'limit_date',
    'return_date',
    'receipt_date',
    [
        'format' => 'html',
        'label' => \Yii::t('app/library', 'Options'),
        'value' => function (app\models\BookAtUser $modelBookAtUser) {
            return
                Html::a(\Yii::t('app/library', 'View'), ['book-at-user/view', 'id' => $modelBookAtUser->id], ['class' => 'btn btn-default']);
        },
    ]
];

$this->title = \Yii::t('app/library', 'CRUD Users');
?>

<h2><?= \Yii::t('app/library', 'User info'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['update', 'id' => $modelUser->id]); ?>"><?= \Yii::t('app/library', 'Update'); ?></a>
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
        <h4><?= \Yii::t('app/library', 'Book at user actual'); ?></h4>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderBookAtUserActual,
            'columns' => $columnsGridViewForBookAtUser,
        ]);
        ?>
    </div>
    <div class="col-md-6">
        <h4><?= \Yii::t('app/library', 'Book at user overdue'); ?></h4>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderBookAtUserOverdue,
            'columns' => $columnsGridViewForBookAtUser,
        ]);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4><?= \Yii::t('app/library', 'Messages to librarian'); ?></h4>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderMessage,
            'columns' => [
                'id',
                [
                    'attribute' => 'text_message',
                    'value' => function (app\models\Message $modelMessage) {
                        return $modelMessage->text_message;
                    },
                ],
                'create_time',
            ],
        ]);
        ?>
    </div>
</div>
