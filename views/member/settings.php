<?php

use app\models\Role;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Profile Settings';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<hr>
<div class="card shadow">
    <div class="card-header" align="center">
        <h3>Settings</h3>
    </div>
    <div class="card-body" >
        <ul>
            <li><a href="<?= Url::toRoute(['member/update', 'id' => Yii::$app->session['member']]) ?>">Update my profile</a></li>
            <li><a href="<?= Url::toRoute(['role-status/index']) ?>">Leadership History</a></li>
            <li><a href="changepassword">Change my password</a></li>
        </ul>
    </div>
</div>