<?php

$session = Session::getInstance();
$session->restrictAdmin();

$action = Url::getParam('action');

switch($action) {
	
	case 'add':
	require_once('admins/add.php');
	break;
	
	case 'added':
	require_once('admins/added.php');
	break;
	
	case 'added-failed':
	require_once('admins/added-failed.php');
	break;
	
	case 'edit':
	require_once('admins/edit.php');
	break;
	
	case 'edited':
	require_once('admins/edited.php');
	break;
	
	case 'edited-failed':
	require_once('admins/edited-failed.php');
	break;
	
	case 'remove':
	require_once('admins/remove.php');
	break;
	
	default:
	require_once('admins/list.php');

}







