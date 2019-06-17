<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-12
 * Time: 16:52
 */

use Helpers\Url;
?>

<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="<?= DIR . Url::URL_INS_NEW ?>" method="post">
            <div class="form-group has-feedback">
                <input id="nom" name="nom" type="text" class="form-control" placeholder="Nom">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="prenom" name="prenom" type="text" class="form-control" placeholder="prenom">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="mail" name="mail" type="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="new_password" name="new_password" type="password" class="form-control" placeholder="Retype password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat" disabled>Je m'inscris !</button>
        </form>
        <hr>
        <a href="<?= DIR ?>" class="btn btn-success btn-flat btn-block">Je suis déjà membre !</a>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    $("#mail").on("input",function(){
        if(validateEmail($(this).val())){
            $(this).css("border" , "1px solid #d2d6de");
        }else{
            $(this).css("border" , "2px solid red");
        }
    });

    $("#new_password").on("input", function(){
        if($(this).val() == $("#password").val()){
            $(this).css("border" , "1px solid #d2d6de");
        }else{
            $(this).css("border" , "2px solid red");
        }
    });
</script>
