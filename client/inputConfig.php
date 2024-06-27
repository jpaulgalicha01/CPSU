<?php
include 'includes/autoload.inc.php';

if($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET"){
	if(isset($_REQUEST['declined_user'])){
		$user_id = secured($_REQUEST['declined_user']);

		$decline_user = new update();
		$decline_user->declineUser($user_id);
	}elseif(isset($_REQUEST['accept_user'])){
		$user_id = secured($_REQUEST['accept_user']);

		$accept_user = new update();
		$accept_user->acceptUser($user_id);
	}elseif(isset($_REQUEST['delete_user'])){
		$user_id = secured($_REQUEST['delete_user']);

		$delete_user = new delete();
		$delete_user->deleteUser($user_id);
	}elseif(isset($_POST['value']) && $_POST['function'] == "view_user"){
		$user_id = secured($_POST['value']);

		$view_user = new fetch();
		$view_user->viewUser($user_id);
	}elseif(isset($_POST['delete_user_acc']) && $_POST['function']=="delete_user_acc"){
		$user_id = secured($_POST['user_id']);

		$delete_user = new delete();
		$delete_user->deleteUser($user_id);
	}elseif(isset($_POST['change_profile']) && secured($_POST['function'] == "change_profile")){
		$change_img = $_FILES['change_img']['name'];

		$change_prof_img = new update();
		$change_prof_img->changeProfImg($change_img);
	}elseif(isset($_POST['update_info']) && secured($_POST['function'] == "update_info")){
		$acc_fname = secured($_POST['acc_fname']);
        $acc_mname = secured($_POST['acc_mname']);
        $acc_lname = secured($_POST['acc_lname']);
        $acc_lname = secured($_POST['acc_lname']);
        $acc_address = secured($_POST['acc_address']);
        $acc_birth = secured($_POST['acc_birth']);
        $acc_phone = secured($_POST['acc_phone']);
        $acc_email = secured($_POST['acc_email']);
        $acc_uname = secured($_POST['acc_uname']);
        $curr_pass = secured($_POST['curr_pass']);
        $new_pass = secured($_POST['new_pass']);

        $update_info = new update();
        $update_info->updateInfo($acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,$acc_phone,$acc_email,$acc_uname,$curr_pass,$new_pass);
	}else{
		ob_end_flush(header("Location: index.php"));
	}
}else{
	return false;
}

?>