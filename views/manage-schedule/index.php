<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TitheOffering */

$this->title = 'Manage Worship Schedules';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-md-6">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Worship Schedule</h5>
                <p class="card-text">Manage Officer on duty (Preacher, Choristers, Deacons, etc.), Worship programmes,
                    etc.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/weekly-schedule/index']));?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Bulletin and Publicity</h5>
                <p class="card-text">Manage/Edit the weekly publicity bulletin, church contacts,
                </p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/weekly-schedule/bulletins']));?>

            </div>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Announcements</h5>
                <p class="card-text">Manage/Edit weekly Announcements.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/weekly-schedule/announcements']));?>
            </div>
        </div>
    </div>
</div>