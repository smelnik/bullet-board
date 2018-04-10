<?php

use common\models\UserInfo;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var UserInfo $userInfo
 * @var bool $isOwner
 */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-profile">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($isOwner) { ?>
        <p>Tell us a little about yourself</p>

        <?php $form = ActiveForm::begin(['id' => 'profile-form']); ?>
        <?= $form->field($userInfo, 'first_name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($userInfo, 'middle_name')->textInput() ?>
        <?= $form->field($userInfo, 'last_name')->textInput() ?>
        <?= $form->field($userInfo, 'phone')->textInput() ?>

        <?php // date-birth picker ?>

        <div class="form-group">
            <?= $form->field($userInfo, 'avatar_url')->fileInput() ?>
            <?php if (!empty($userInfo->avatar_url)) { ?>
                <img src="<?= '/uploads/users/' . $userInfo->user_id . '/' . $userInfo->avatar_url ?>" />
            <?php } ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?php } ?>

</div>
