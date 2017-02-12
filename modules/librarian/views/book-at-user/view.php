<?php
/**
 * @var yii\web\View $this
 * @var app\models\BookAtUser $modelBookAtUser
 */

use yii\helpers\Html;

$this->title = \Yii::t('app/library', 'CRUD Book at user');
?>

<h2><?= \Yii::t('app/library', 'Book at user info'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['update', 'id' => $modelBookAtUser->id]); ?>"><?= \Yii::t('app/library', 'Update'); ?></a>
    <? if (!$modelBookAtUser->return_date) { ?>
        <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['return', 'id' => $modelBookAtUser->id]); ?>"><?= \Yii::t('app/library', 'Return'); ?></a>
    <? } ?>
</p>

<?= yii\widgets\DetailView::widget([
    'model' => $modelBookAtUser,
    'attributes' => [
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
    ],
]);
?>
