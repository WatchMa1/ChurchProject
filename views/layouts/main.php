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
use app\models\User;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\RoleStatus;
use app\models\Department;

$user = User::findOne(User::getCurrentUserID());

$session = Yii::$app->session;
$name = $session['name'];
$department = Department::findOne(['id' => $session['department']]);
AppAsset::register($this);

//var_dump($session['department']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<header>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
    <title><?= Html::encode($this->title . ' | UniSDA') ?></title>
    <link rel="icon"
        href="https://www.adventist.org/wp-content/themes/alps-wordpress-v3/assets/images/favicon--bluejay.png">
</header>

<body>


    <?php $this->beginBody() ?>

    <style>
    body {
        /*background-image: url('churchpic.png');*/
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }
    </style>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-unza sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="<?= Url::toRoute(['home/index']) ?>">
                <div class="sidebar-brand-icon">
                    <img src="data:image/png;base64,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"
                        alt="Logo" style="width:25px; height:35px;">
                </div>
                <div class="sidebar-brand-text mx-2">University SDA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <?php if(User::userIsAllowedTo("Manage Users")){?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item" id="dashboard">
                <a class="nav-link" href="<?= Url::toRoute('home/index') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item" id="user">
                <a class="nav-link" id="manageUser" href="<?= Url::toRoute('user/index') ?>"><i
                        class="fas fa-fw fa-users-cog"></i> <span>Manage Users</span></a>
            </li>
            <li class="nav-item" id="user">
                <a class="nav-link" id="manageUser" href="<?= Url::toRoute('department/index') ?>"><i
                        class="fas fa-building"></i> <span>Departments</span></a>
            </li>

            <li class="nav-item" id="user">
                <a class="nav-link" id="manageUser" href="<?= Url::toRoute('strategic-plan/index') ?>"><i
                        class="far fa-compass"></i> <span>Strategic Plan</span></a>
            </li>

            <li class="nav-item" id="manage-schedules-menu">
                <a class="nav-link" id="manageSchedules" href="<?= Url::toRoute('manage-schedule/index') ?>"><i
                        class="fas fa-calendar-day"></i> <span>Worship Schedules</span></a>
            </li>

            <li class="nav-item" id="church-officers">
                <a class="nav-link" id="churchOfficers" href="<?= Url::toRoute('church-officers/index') ?>"><i
                        class="fas fa-calendar-day"></i> <span>Church Officers</span></a>
            </li>

            <li class="nav-item" id="finance-and-reports">
                <a class="nav-link" id="financeAndReports" href="<?= Url::toRoute('finance-and-reports/index') ?>"><i
                        class="fas fa-money-check"></i> <span>Finance & Reports</span></a>
            </li>
            <li class="nav-item" id="minister-menu">
                <a class="nav-link" id="minister" href="<?= Url::toRoute('minister/index') ?>"><i
                        class="fas fa-user-tie"></i> <span>Ministers</span></a>
            </li>

            <li class="nav-item" id="cong">
                <a class="nav-link" id="manageCong" href="<?= Url::toRoute('member/index') ?>"><i
                        class="fas fa-fw fa-church"></i> <span>Congregation</span></a>
            </li>

            <?php } ?>
            <?php if(User::userIsAllowedTo("Create Member") || User::userIsAllowedTo("Manage Department") || User::userIsAllowedTo("Manage Users")){?>
            <li class="nav-item" id="member">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                    aria-expanded="true" aria-controls="collapseUser">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Profile Management</span>
                </a>
                <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" id="manageFamily" href="<?= Url::toRoute('family/create') ?>">Family
                            Details</a>
                        <?php
                        if(!isset(Yii::$app->session['member'])) {
                        ?>
                        <a class="collapse-item" id="profile" href="<?= Url::toRoute('member/create') ?>">Create
                            Profile</a>
                        <?php } else { ?>
                        <a class="collapse-item" id="profile"
                            href="<?= Url::toRoute(['member/view', 'id' => Yii::$app->session['member']]) ?>">My
                            Profile</a>
                        <?php } ?>
                        <a class="collapse-item" id="addFamily" href="<?= Url::toRoute('member/family') ?>">Family
                            Members</a>
                        <a class="collapse-item" id="userSignatures"
                            href="<?= Url::toRoute('user-signatures/index') ?>">My
                            Signature</a>
                        <a class="collapse-item" id="profile" href="<?= Url::toRoute('member/settings') ?>">Settings</a>
                    </div>
                </div>

            </li>
            <?php if(!User::userIsAllowedTo("Manage Users")){?>

            <li class="nav-item" id="manage-schedules-menu">
                <a class="nav-link" id="manageSchedules" href="<?= Url::toRoute('weekly-schedule/weekly-bulletins') ?>"><i
                        class="fas fa-calendar-day"></i> <span>Worship Schedules</span></a>
            </li>
            <?php } ?>
            <li class="nav-item" id="department">
                <a class="nav-link" id="formsAndEntries" href="<?= Url::toRoute('forms-and-entries/index') ?>"><i
                        class="fas fa-clipboard-list" aria-hidden="true"></i> <span>Forms and Entries</span></a>
            </li>
            <?php } ?>
            <?php if(User::userIsAllowedTo("Manage Department")){?>
            <li class="nav-item" id="department">
                <a class="nav-link" id="department" href="<?= Url::toRoute('department-member/') ?>"><i
                        class="fa fa-users"></i> <span>Department Members</span></a>
            </li>
            <li class="nav-item" id="finance-and-reports">
                <a class="nav-link" id="financeAndReports" href="<?= Url::toRoute('finance-and-reports/index') ?>"><i
                        class="fas fa-money-check"></i> <span>Finance & Reports</span></a>
            </li>
            <?php if (isset($department)){
                if($department->name == 'Prayer Band'){?>
            <li class="nav-item" id="department">
                <a class="nav-link" id="department" href="<?= Url::toRoute('member/index') ?>"><i
                        class="fa fa-users"></i> <span>Church Members</span></a>
            </li>
            <li class="nav-item" id="department">
                <a class="nav-link" id="department" href="<?= Url::toRoute('ministers/index') ?>"><i
                        class="fa fa-user"></i> <span>Ministers</span></a>
            </li>
            <?php }?>
            <?php if($department->name == 'SPMEC'){ ?>
            <li class="nav-item" id="department">
                <a class="nav-link" id="department" href="<?= Url::toRoute('scorecard/index2') ?>"><i
                        class="far fa-address-book"></i> <span>Church Scorecard</span></a>
            </li>
            <?php }?>
            <li class="nav-item" id="department">
                <a class="nav-link" id="manageUser" href="<?= Url::toRoute('scorecard/index2') ?>"><i
                        class="fas fa-clipboard"></i> <span>Department Scorecard</span></a>
            </li>

            <li class="nav-item" id="department">
                <a class="nav-link" id="manageUser" href="<?= Url::toRoute('accomplished-activity/index') ?>"><i
                        class="fas fa-clipboard-list" aria-hidden="true"></i> <span>Department Report</span></a>
            </li>

            <?php if($department->name == 'Interest Coordinator'){?>

            <li class="nav-item" id="department">
                <a class="nav-link" id="department" href="<?= Url::toRoute('interest/') ?>"><i
                        class="far fa-address-book"></i> <span>Visitors/Interests</span></a>
            </li>
            <?php }?>
            <?php } }?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Modal -->


                    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="helpModalLabel">Help</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php if(isset($this->params['help'])) {
                                echo $this->params['help'];
                            } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Help -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="help" role="button" data-toggle="modal"
                                data-target="#helpModal">
                                <i class="fas fa-question fa-fw"></i>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?= Html::encode(ucwords($name)) ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?=
            Breadcrumbs::widget([
                'homeLink' => ['label' => 'Home',
                    'url' => Yii::$app->getHomeUrl() . 'home/index'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
                    <?= $content ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; <?= date("Y")?> - Congregation Management System</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <?= Html::a('<span>Logout</span>', ['site/logout'], ['data' => ['method' => 'POST'], 'id' => 'logout',
                'class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    <script>
    var myArrSuccess = [<?php
        $flashMessage = Yii::$app->session->getFlash('success');
        if ($flashMessage) {
            echo '"' . $flashMessage . '",';
        }
        ?>];
    for (var i = 0; i < myArrSuccess.length; i++) {
        $.notify(myArrSuccess[i], {
            type: 'success',
            offset: 70,
            allow_dismiss: true,
            newest_on_top: true,
            timer: 5000,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }
    var myArrInfo = [<?php
        $flashMessage = Yii::$app->session->getFlash('info');
        if ($flashMessage) {
            echo '"' . $flashMessage . '",';
        }
        ?>];
    for (var j = 0; j < myArrInfo.length; j++) {
        $.notify(myArrInfo[j], {
            type: 'info',
            offset: 70,
            allow_dismiss: true,
            newest_on_top: true,
            timer: 5000,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }
    var myArrError = [<?php
        $flashMessage = Yii::$app->session->getFlash('error');
        if ($flashMessage) {
            echo '"' . $flashMessage . '",';
        }
        ?>];
    for (var j = 0; j < myArrError.length; j++) {
        $.notify(myArrError[j], {
            type: 'danger',
            offset: 70,
            allow_dismiss: true,
            newest_on_top: true,
            timer: 5000,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }
    </script>
    <script>
    var current_path = window.location.pathname;
    var path_string = current_path.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, ' ');
    console.log(path_string);
    if (path_string.indexOf("home") > 0) {
        document.getElementById("dashboard").className += " active";
    } else if (path_string.indexOf("user-signatures") > 0) {
        if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            document.getElementById("collapseUser").className += " show";
        }
        document.getElementById("member").className += " active";
        document.getElementById("userSignatures").className += " active";
    } else if (path_string.indexOf("user") > 0) {
        document.getElementById("user").className += " active";
    } else if (path_string.indexOf("finance-and-reports") > 0) {
        document.getElementById("finance-and-reports").className += " active";
    } else if (path_string.indexOf("member") > 0) {
        document.getElementById("member").className += " active";
        if (path_string.indexOf("family") > 0) {
            document.getElementById("addFamily").className += " active";
        } else {
            document.getElementById("profile").className += " active";
        }
        if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            document.getElementById("collapseUser").className += " show";
        }
        document.getElementById("manageRole").className += " active";
    } else if (path_string.indexOf("family") > 0) {
        document.getElementById("member").className += " active";
        document.getElementById("manageFamily").className += " active";
        if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            document.getElementById("collapseUser").className += " show";
        }
        document.getElementById("manageRole").className += " active";
    }
    </script>
</body>

</html>
<?php $this->endPage() ?>