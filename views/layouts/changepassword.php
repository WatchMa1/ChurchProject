<?php
/**
 * Created by PhpStorm.
 * User: Alinani
 * Date: 2019-04-12
 * Time: 13:07
 */
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="https://www.adventist.org/wp-content/themes/alps-wordpress-v3/assets/images/favicon--bluejay.png">
</head>

<body class="bg-gray-100">
<?php $this->beginBody() ?>
    
    <style>
body {
  background-image: url('churchpic.png');
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
}
</style>
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                      <img src="https://www.adventist.org/wp-content/themes/alps-wordpress-v3/assets/images/favicon--bluejay.png" alt="Logo" style="width:70px; height:85px;">
                      <h3 class="h4 text-gray-900 mb-4" style="font-family:Courier New, monospace;">University Church Congregation Management System</h3>
                      
                    <?= $content ?>
                  <hr>
                  <div class="text-center">
                    <a class="small" href=<?= Url::toRoute('site/index') ?> >Login</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</div>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
