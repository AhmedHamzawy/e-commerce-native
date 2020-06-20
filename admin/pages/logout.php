<?php
$session = Session::getInstance();
$session->logout(Login::$_login_admin);
$session->restrictAdmin();