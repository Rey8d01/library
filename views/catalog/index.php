<?php
/**
 * @var yii\web\View $this
 * @var app\models\Book $modelBook
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var array $authorIds
 * @var array $tagIds
 */

$this->title = 'Library';
?>

<h1><?= \Yii::t('app/library', 'Catalog library'); ?></h1>

<div class="row">
    <div class="col-md-3">
        <?php $form = yii\widgets\ActiveForm::begin([
            'method' => 'GET',
            'action' => ['catalog/index'],
            'options' => [
//                'data-pjax' => 1
            ]
        ]); ?>

        <h4><?= \Yii::t('app/library', 'Authors'); ?></h4>
        <?php
        $dataProviderAuthor = new yii\data\ActiveDataProvider([
            'query' => app\models\Author::find(),
            'pagination' => false,
            'sort' => false,
        ]);

        echo yii\grid\GridView::widget([
            'dataProvider' => $dataProviderAuthor,
            'columns' => [
                'name',
                [
                    'class' => yii\grid\CheckboxColumn::class,
                    'name' => 'authors',
                    'checkboxOptions' => function (app\models\Author $modelAuthor) use ($authorIds) {
                        $options = ['value' => $modelAuthor->id];
                        return array_search($modelAuthor->id, $authorIds) === false ? $options : $options + ['checked' => 'checked'];
                    }
                ]
            ],
        ]);
        ?>

        <h4><?= \Yii::t('app/library', 'Tags'); ?></h4>
        <?php
        $dataProviderTag = new yii\data\ActiveDataProvider([
            'query' => app\models\Tag::find(),
            'pagination' => false,
            'sort' => false,
        ]);

        echo yii\grid\GridView::widget([
            'dataProvider' => $dataProviderTag,
            'columns' => [
                'title',
                [
                    'class' => yii\grid\CheckboxColumn::class,
                    'name' => 'tags',
                    'checkboxOptions' => function (\app\models\Tag $modelTag) use ($tagIds) {
                        $options = ['value' => $modelTag->id];
                        return array_search($modelTag->id, $tagIds) === false ? $options : $options + ['checked' => 'checked'];
                    }
                ]
            ],
        ]);
        ?>

        <div class="form-group">
            <?= \yii\helpers\Html::submitButton('Применить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php yii\widgets\ActiveForm::end(); ?>
    </div>
    <div class="col-md-9">

        <?php \yii\widgets\Pjax::begin(); ?>
        <?= yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_itemBook',
        ]);
        ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>
