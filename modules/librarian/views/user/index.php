<?php
/**
 * @var yii\web\View $this
 * @var app\models\User $modelUser
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Html;

$this->title = \Yii::t('app/library', 'CRUD Users');
?>

<h2><?= \Yii::t('app/library', 'Users'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['index']); ?>"><?= \Yii::t('app/library', 'All'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['debtors']); ?>"><?= \Yii::t('app/library', 'Only debtors'); ?></a>
</p>

<hr>

<?= yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $modelUser,
    'columns' => [
        'id',
        'first_name',
        'last_name',
        'email',
        [
            'label' => \Yii::t('app/library', 'Actual count books at user'),
            'value' => function (app\models\User $modelUser) {
                return $modelUser->getActualBooksAtUser()->count();
            },
        ],
        [
            'format' => 'html',
            'label' => \Yii::t('app/library', 'Options'),
            'value' => function (app\models\User $modelUser) {
                return
                    Html::a(\Yii::t('app/library', 'View'), ['view', 'id' => $modelUser->id], ['class' => 'btn btn-default']) . ' ' .
                    Html::a(\Yii::t('app/library', 'Update'), ['update', 'id' => $modelUser->id], ['class' => 'btn btn-default']);
            },
        ]
    ],
]);
?>
