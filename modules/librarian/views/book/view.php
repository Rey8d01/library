<?php
/**
 * @var yii\web\View $this
 * @var app\models\Book $modelBook
 * @var yii\data\ActiveDataProvider $dataProviderAuthor
 * @var yii\data\ActiveDataProvider $dataProviderTag
 * @var yii\data\ActiveDataProvider $dataProviderBookAtUser
 */

use yii\helpers\Html;

$this->title = \Yii::t('app/library', 'CRUD Books');
?>

<h2><?= \Yii::t('app/library', 'Book info'); ?></h2>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['create']); ?>"><?= \Yii::t('app/library', 'Add'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['update', 'id' => $modelBook->id]); ?>"><?= \Yii::t('app/library', 'Update'); ?></a>
</p>

<?= \yii\widgets\DetailView::widget([
    'model' => $modelBook,
    'attributes' => [
        'id',
        'title',
        'alias',
        'description',
        'photo',
        'copies',
        [
          'label' => \Yii::t('app/library', 'Count current holders'),
          'value' => function (app\models\Book $modelBook) {
              return $modelBook->getCountCurrentHolders();
          },
        ],
        [
          'label' => \Yii::t('app/library', 'Count all holders'),
          'value' => function (app\models\Book $modelBook) {
              return $modelBook->getCountAllHolders();
          },
        ],
    ],
]);
?>

<div class="row">
    <div class="col-md-6">
        <h4><?= \Yii::t('app/library', 'Authors'); ?></h4>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderAuthor,
            'columns' => [
                'id',
                'name',
            ]
        ]);
        ?>
    </div>
    <div class="col-md-6">
        <h4><?= \Yii::t('app/library', 'Tags'); ?></h4>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderTag,
            'columns' => [
                'id',
                'title',
            ]
        ]);
        ?>
    </div>

    <div class="col-md-12">
        <h4><?= \Yii::t('app/library', 'Book at user'); ?></h4>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderBookAtUser,
            'columns' => [
                'id',
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
                            Html::a(\Yii::t('app/library', 'View'), ['book-at-user/view', 'id' => $modelBookAtUser->id], ['class' => 'btn btn-default']);
                    },
                ]
            ],
        ]);
        ?>
    </div>
</div>
