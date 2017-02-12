<?php
/**
 * @var yii\web\View $this
 * @var app\models\User $modelMessage
 * @var yii\data\ActiveDataProvider $dataProviderMessage
 */

use app;
use yii\helpers\Html;

$this->title = \Yii::t('app/library', 'CRUD Messages');
?>

<h2><?= \Yii::t('app/library', 'Messages'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['index']); ?>"><?= \Yii::t('app/library', 'All'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['from-debtors']); ?>"><?= \Yii::t('app/library', 'Only from debtors'); ?></a>
</p>

<hr>

<?= yii\grid\GridView::widget([
    'dataProvider' => $dataProviderMessage,
    'filterModel' => $modelMessage,
    'columns' => [
        'id',
        [
          'attribute' => 'user_id',
          'format' => 'html',
          'value' => function (\app\models\Message $modelMessage) {
            return Html::a($modelMessage->user->email, ['user/view', 'id' => $modelMessage->user_id]);
          },
        ],
        'text_message',
        'create_time',
    ],
]);
?>
