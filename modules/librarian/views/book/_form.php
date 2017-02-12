<?php
/**
 * @var yii\web\View $this
 * @var app\models\Book $modelBook
 * @var yii\widgets\ActiveForm $form
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$authorIds = $modelBook->getRelIds('authors');
$tagIds = $modelBook->getRelIds('tags');
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($modelBook, 'title')->textInput(); ?>
<?= $form->field($modelBook, 'alias')->textInput(); ?>
<?= $form->field($modelBook, 'description')->textarea(); ?>
<?= $form->field($modelBook, 'photo')->textInput(); ?>
<?= $form->field($modelBook, 'copies')->textInput(); ?>

<div class="row">
    <div class="col-md-6">
        <h4><?= \Yii::t('app/library', 'Set authors for book'); ?></h4>
        <?
        $dataProvider = new yii\data\ActiveDataProvider([
            'query' => app\models\Author::find(),
            'pagination' => false,
            'sort' => false,
        ]);

        echo yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'name',
                [
                    'class' => yii\grid\CheckboxColumn::class,
                    'name' => 'authors',
                    'checkboxOptions' => function (\app\models\Author $modelAuthor) use ($authorIds) {
                        $options = ['value' => $modelAuthor->id];
                        return array_search($modelAuthor->id, $authorIds) === false ? $options : $options + ['checked' => 'checked'];
                    }
                ]
            ],
        ]);
        ?>
    </div>
    <div class="col-md-6">
        <h4><?= \Yii::t('app/library', 'Set tags for book'); ?></h4>
        <?
        $dataProvider = new yii\data\ActiveDataProvider([
            'query' => app\models\Tag::find(),
            'pagination' => false,
            'sort' => false,
        ]);

        echo yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
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
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton($modelBook->getIsNewRecord() ?  \Yii::t('app/library', 'Create') :  \Yii::t('app/library', 'Update'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
