<?php
/**
 * @var yii\web\View $this
 * @var app\models\BookAtUser $modelBookAtUser
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Html;

$this->title = \Yii::t('app/library', 'CRUD Book at user');
?>

<h2><?= \Yii::t('app/library', 'Book at user'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['index']); ?>"><?= \Yii::t('app/library', 'All'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['not-returned']); ?>"><?= \Yii::t('app/library', 'Only not returned'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['overdue']); ?>"><?= \Yii::t('app/library', 'Only overdue'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
</p>

<hr>

<?= yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $modelBookAtUser,
    'columns' => [
        'id',
        [
            'attribute' => 'book_id',
            'format' => 'html',
            'value' => function (app\models\BookAtUser $modelBookAtUser) {
                return Html::a($modelBookAtUser->book->title, ['book/view', 'id' => $modelBookAtUser->book_id]);
            },
        ],
        [
            'attribute' => 'user_id',
            'format' => 'html',
            'value' => function (app\models\BookAtUser $modelBookAtUser) {
                return Html::a($modelBookAtUser->user->email, ['user/view', 'id' => $modelBookAtUser->user_id]);
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
                    Html::a(\Yii::t('app/library', 'View'), ['book-at-user/view', 'id' => $modelBookAtUser->id], ['class' => 'btn btn-default']) . ' ' .
                    Html::a(\Yii::t('app/library', 'Update'), ['book-at-user/update', 'id' => $modelBookAtUser->id], ['class' => 'btn btn-default']) . ' ' .
                    Html::a(\Yii::t('app/library', 'Delete'), ['book-at-user/delete', 'id' => $modelBookAtUser->id], ['class' => 'btn btn-danger']);
            },
        ]
    ],
]);
?>
