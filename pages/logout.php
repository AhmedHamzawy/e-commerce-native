<?php
$session = Session::getInstance();
$session->logout(Login::$_login_front) ? $session->restrictFront() : var_dump('error');
