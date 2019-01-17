<?php
use backend\assets\PressAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
PressAsset::register($this);

$model->rememberMe = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Admin Press Admin Template - The Ultimate Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="../theme/adminpress/dist/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper">
    <div class="login-register" style="background-image:url(../web/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>

                <!--                <form class="form-horizontal form-material" id="loginform" method="post" action="--><?//=Url::to(['site/login'],true)?><!--">-->
                    <h3 class="box-title m-b-20">ลงชื่อเข้าใช้งานระบบ</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <?= $form->field($model, 'username')->textInput(['placeholder'=>'ชื่อผู้ใช้','maxlength' => true,'class'=>'form-control','required'=>'required'])->label(false) ?>
<!--                            <input class="form-control" name="username" type="text" required="" placeholder="ชื่อผู้ใช้"> </div>-->
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control','placeholder'=>'รหัสผ่าน','required'=>'required'])->label(false) ?>
<!--                            <input class="form-control" name="password" type="password" required="" placeholder="รหัสผ่าน"> </div>-->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 font-14">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <?= $form->field($model, 'rememberMe')->hiddenInput(['id'=>'rememberme'])->label(false) ?>
                                <input id="checkbox-signup" type="checkbox" onchange="changecheck($(this))">
                                <label for="checkbox-signup"> จดจำการใช้งานของฉันไว้ </label>
                            </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><!-- <i class="fa fa-lock m-r-5"></i> --> ลืมรหัสผ่าน?</a> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">เข้าสู่ระบบ</button>
                        </div>
                    </div>
<!--                    <div class="row">-->
<!--                        <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">-->
<!--                            <div class="social">-->
<!--                                <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>-->
<!--                                <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <div>คุณยังไม่มีบัญชีผู้ใช้ใช่หรือไม่? <a href="pages-register.html" class="text-info m-l-5"><b>ลงทะเบียน</b></a></div>
                        </div>
                    </div>
<!--                </form>-->
                <?php ActiveForm::end();?>
                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email"> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="../theme/adminpress/dist/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../theme/adminpress/dist/plugins/bootstrap/js/popper.min.js"></script>
<script src="../theme/adminpress/dist/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="../theme/adminpress/dist/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="../theme/adminpress/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="../theme/adminpress/dist/js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="../theme/adminpress/dist/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="../theme/adminpress/dist/plugins/sparkline/jquery.sparkline.min.js"></script>
<!--Custom JavaScript -->
<script src="../theme/adminpress/dist/js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="../theme/adminpress/dist/plugins/styleswitcher/jQuery.style.switcher.js"></script>
<script>
    $(function () {

    });
    function changecheck(e){
        var rem = $("#rememberme").val();
        if(rem == 1){
            $("#rememberme").val(0);
        }else{
            $("#rememberme").val(1);
        }
    }
</script>
</body>

</html>
