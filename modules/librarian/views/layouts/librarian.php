<?php
/**
 * @var \yii\web\View $this
 * @var string $content
 */
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<h1><?= \Yii::t('app/library', 'Managment library'); ?></h1>

<div class="row">
    <div class="col-md-12">
        <p>
            <a class="btn btn-default" href="<?= yii\helpers\Url::to(['user/index']); ?>"><?= \Yii::t('app/library', 'Users'); ?></a>
            <a class="btn btn-default" href="<?= yii\helpers\Url::to(['book/index']); ?>"><?= \Yii::t('app/library', 'Books'); ?></a>
            <a class="btn btn-default" href="<?= yii\helpers\Url::to(['tag/index']); ?>"><?= \Yii::t('app/library', 'Tags'); ?></a>
            <a class="btn btn-default" href="<?= yii\helpers\Url::to(['author/index']); ?>"><?= \Yii::t('app/library', 'Authors'); ?></a>
            <a class="btn btn-default" href="<?= yii\helpers\Url::to(['book-at-user/index']); ?>"><?= \Yii::t('app/library', 'Book at user'); ?></a>
            <a class="btn btn-default" href="<?= yii\helpers\Url::to(['message/index']); ?>"><?= \Yii::t('app/library', 'Messages'); ?></a>
        </p>
    </div>
</div>

<?= $content ?>

<?php $this->endContent(); ?>
