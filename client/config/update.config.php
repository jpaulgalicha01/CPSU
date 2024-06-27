<?php
class update extends controller{
	public function declineUser($user_id){
		$stmt = $this->decline_user($user_id);
		if($stmt){
			$_SESSION['declined_user_id'] = $user_id;
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "success";
			$_SESSION['title_alert'] = "Successfully Updated";
			ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
		}
	}
	public function acceptUser($user_id){
		$stmt = $this->accept_user($user_id);
		if($stmt){
			$_SESSION['accept_user_id'] = $user_id;
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "success";
			$_SESSION['title_alert'] = "Successfully Updated";
			ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
		}
	}

	

	public function changeProfImg($change_img){
		$stmt = $this->change_prof_img($change_img);

		if(!$stmt){
		    $_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Somthing Wrong. Please try againg";
			ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
		}
		if($stmt !==1){
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = $stmt;
			ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
		}
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "success";
			$_SESSION['title_alert'] = "Successfully Updated";
			ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
	}

	public function updateInfo($acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,$acc_phone,$acc_email,$acc_uname,$curr_pass,$new_pass){
		$stmt = $this->update_info($acc_fname,$acc_mname,$acc_lname,$acc_address,$acc_birth,$acc_phone,$acc_email,$acc_uname,$curr_pass,$new_pass);

		if(!$stmt){
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Somthing Wrong. Please try againg";
			ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
		}else{
			switch ($stmt) {
				case '1':
					$_SESSION['alert'] = "Show";
					$_SESSION['icon'] = "success";
					$_SESSION['title_alert'] = "Successfully Updated";
					ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
					break;
				
				default:
					$_SESSION['alert'] = "Show";
					$_SESSION['icon'] = "error";
					$_SESSION['title_alert'] = $stmt;
					ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
					break;
			}
		}
	}
}
?>