<?php
require_once('../inc/autoload.php');

Session::getInstance();

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	Session::removeItem($id);
}