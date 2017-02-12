<?php
/**
 * @var yii\web\View $this
 * @var app\models\User $modelUser
 * @var yii\data\ActiveDataProvider $dataProviderMessage
 */

$this->title = \Yii::t('app/library', 'Profile');
?>

<h1><?= $this->title; ?></h1>

<p>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['user/index']); ?>"><?= \Yii::t('app/library', 'Profile'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['message/index']); ?>"><?= \Yii::t('app/library', 'Messages to librarian'); ?></a>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['message/new-message']); ?>"><?= \Yii::t('app/library', 'New message'); ?></a>
</p>

<div class="row">
    <div class="col-md-12">

        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) { ?>

            <div class="alert alert-success">
                Thank you for contacting us. We will respond to you as soon as possible.
            </div>
        <?php } ?>

        <h4><?= \Yii::t('app/library', 'Your messages to librarian'); ?></h4>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProviderMessage,
            'columns' => [
                'id',
                [
                    'attribute' => 'text_message',
                    'value' => function (app\models\Message $modelMessage) {
                        return \yii\helpers\HtmlPurifier::process($modelMessage->text_message);
                        return \yii\helpers\Html::encode($modelMessage->text_message);
                    },
                ],
                'create_time',
            ],
        ]);
        ?>
    </div>
</div>
