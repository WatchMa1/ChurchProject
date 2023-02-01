<?php

use app\models\Address;
use app\models\Member;
use app\models\MembershipStatus;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\models\RemindersAndNoticesSearch;

$this->title = 'Dashboard';
$members = Member::find()->all();
$to19 = 0;
$to39 = 0;
$to59 = 0;
$from60 = 0;
if(!empty($members)){
    foreach($members as $member) {
        $age = DateTime::createFromFormat('Y-m-d', $member->date_of_birth)->diff(new DateTime('now'))->y;
        if($age < 20) {
            $to19 += 1;
        } else if($age < 40) {
            $to39 += 1;
        } else if($age < 60) {
            $to59 += 1;
        } else {
            $from60 += 1;
        }
    }
}
$sum = $to19+$to39+$to59+$from60;
$js1 = "
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,\"Segoe UI\",Roboto,\"Helvetica Neue\",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

var ctx1 = document.getElementById(\"memberGenderChart\");
var genderChart = new Chart(ctx1, {
  type: 'doughnut',
  data: {
    labels: [\"Female\", \"Male\"],
    datasets: [{
      data: [".Member::find()->where(['gender' => 'Female'])->count().", ".Member::find()->where(['gender' => 'Male'])->count()."],
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: \"rgba(234, 236, 244, 1)\",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: \"rgb(255,255,255)\",
      bodyFontColor: \"#858796\",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});";
$js2 = "var ctx2 = document.getElementById(\"memberMaritalChart\");
var maritalChart = new Chart(ctx2, {
  type: 'doughnut',
  data: {
    labels: [\"Single\", \"Married\", \"Divorced\", \"Widowed\"],
    datasets: [{
      data: [".Member::find()->where(['marital_status' => 'Single'])->count().", ".Member::find()->where(['marital_status' =>
        'Married'])->count().", ".Member::find()->where(['marital_status' => 'Divorced'])->count().", ".Member::find()->where(['marital_status' => 'Widowed'])->count()."],
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: \"rgba(234, 236, 244, 1)\",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: \"rgb(255,255,255)\",
      bodyFontColor: \"#858796\",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});";
$js3 = "var ctx3 = document.getElementById(\"memberStatusChart\");
var statusChart = new Chart(ctx3, {
  type: 'doughnut',
  data: {
    labels: [\"Baptised\", \"Not Baptised\"],
    datasets: [{
      data: [".\app\models\MembershipStatus::find()->where(['status' => 1])->count().", ".\app\models\MembershipStatus::find()->where(['status' =>
        2])->count()."],
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: \"rgba(234, 236, 244, 1)\",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: \"rgb(255,255,255)\",
      bodyFontColor: \"#858796\",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});";
$js4 = "
var baptisedChart = new Chart(document.getElementById(\"memberBaptisedChart\"), {
  type: 'doughnut',
  data: {
    labels: [\"Student\", \"University SDA\", \"Other SDA\"],
    datasets: [{
      data: [".MembershipStatus::find()->where(['status' => 1, 'type' => 1])->count().", ".
    MembershipStatus::find()->where(['status' => 1, 'type' => 2])->count().", ".
        \app\models\MembershipStatus::find()->where(['status' => 1, 'type' => 3])->count()."],
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: \"rgba(234, 236, 244, 1)\",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: \"rgb(255,255,255)\",
      bodyFontColor: \"#858796\",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});";
$js5 = "
var notBaptisedChart = new Chart(document.getElementById(\"memberNotBaptisedChart\"), {
  type: 'doughnut',
  data: {
    labels: [\"Student\", \"Sabbath School\"],
    datasets: [{
      data: [".\app\models\MembershipStatus::find()->where(['status' => 2, 'type' => 4])->count().", ".
    \app\models\MembershipStatus::find()->where(['status' => 2, 'type' => 5])->count()."],
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: \"rgba(234, 236, 244, 1)\",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: \"rgb(255,255,255)\",
      bodyFontColor: \"#858796\",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});";
$js6 = "
function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Bar Chart Example
var ageBarChart = new Chart(document.getElementById(\"ageBarChart\"), {
  type: 'bar',
  data: {
    labels: [\"0-19 years\", \"20-39 years\", \"40-59 years\", \"60+ years\"],
    datasets: [{
      label: \"Members\",
      backgroundColor: \"#4e73df\",
      hoverBackgroundColor: \"#2e59d9\",
      borderColor: \"#4e73df\",
      data: [".$to19.", ".$to39.", ".$to59.", ".$from60."],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'age group'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: ".$sum.",
          maxTicksLimit: 5,
          padding: 10,
        },
        gridLines: {
          color: \"rgb(234, 236, 244)\",
          zeroLineColor: \"rgb(234, 236, 244)\",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: \"rgb(255,255,255)\",
      bodyFontColor: \"#858796\",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        }
      }
    },
  }
});";
$js7 = "var maritalChart = new Chart(document.getElementById(\"memberSocialMediaChart\"), {
  type: 'doughnut',
  data: {
    labels: [\"WhatsApp\", \"Facebook\", \"Twitter\", \"Instagram\"],
    datasets: [{
      data: [".Address::find()->select('whatsapp_number')->count().", ".Address::find()->select(
              'facebook_id')->count().", ".Address::find()->select('twitter_id')->count().", ".
    Address::find()->select('instagram_id')->count()."],
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: \"rgba(234, 236, 244, 1)\",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: \"rgb(255,255,255)\",
      bodyFontColor: \"#858796\",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});";
$script = <<< JS
    $js1
    $js2
    $js3
    $js4
    $js5
    $js6
    $js7
JS;
$this->registerJs($script);
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col-xl-4 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= Html::encode(User::find()->count()) ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Members</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= Html::encode(\app\models\Member::find()->count()) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Families</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= Html::encode(\app\models\Family::find()->count()) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
  <div class="card mx-4 col-md-12 shadow mb-4">
  <div class="">

  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">Announcements And Notices</h6> 
        <?= Html::a('more <i class="fas fa-bell"></i>', ['/reminders-and-notices'], ['class' => 'btn btn-sm btn-outline-dark']) ?>
                
      </div>


  <?php

$searchModel = new RemindersAndNoticesSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams,5);
/* @var $searchModel app\models\RemindersAndNoticesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>

<?php 
    if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Manage Department')) {
?>
    <p class="d-flex justify-content-end">
        <?= Html::a('Add notice<i class="fas fa-plus"></i>', ['/reminders-and-notices/create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
}?>


    <?php Pjax::begin(); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            $title = Html::encode($model->title);
            $html = '<div class="border-top pt-2 my-2">';
            $html = $html. '<span class="font-weight-bold">'.Html::a($title, ['/reminders-and-notices/view', 'id' => $model->id]).'</span>';
            $html = $html. '<br> <em>'.date('D - jS M, Y',$model->date_of_notice).'</em>';
            $html = $html.'</div>';
            return $html;
        },
    ]) ?>

    <?php Pjax::end(); ?>

      </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">Members by Gender</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="memberGenderChart" class="chartjs-render-monitor" style="display: block; height: 245px; width: 307px;" width="614" height="490"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Female
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Male
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">Members by Marital Status</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="memberMaritalChart" class="chartjs-render-monitor" style="display: block; height: 245px; width: 307px;" width="614" height="490"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Single
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Married
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Divorced
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Widowed
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">Members by Membership Status</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="memberStatusChart" class="chartjs-render-monitor" style="display: block; height: 245px; width: 307px;" width="614" height="490"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Baptised
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Not Baptised
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">Members by Membership Status - Baptised</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="memberBaptisedChart" class="chartjs-render-monitor" style="display: block; height: 245px; width: 307px;" width="614" height="490"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Student
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> University SDA
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-secondary"></i> Other SDA
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">Members by Membership Status - Not Baptised</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="memberNotBaptisedChart" class="chartjs-render-monitor" style="display: block; height: 245px; width: 307px;" width="614" height="490"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Student
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Sabbath School
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Members by Age Group</h6>
            </div>
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="ageBarChart" class="chartjs-render-monitor" style="display: block; height: 320px; width: 679px;"
                        width="1358" height="640"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">Members by Social Media Platform</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="memberSocialMediaChart" class="chartjs-render-monitor" style="display: block; height: 245px; width: 307px;" width="614" height="490"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> WhatsApp
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Facebook
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Twitter
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Instagram
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>