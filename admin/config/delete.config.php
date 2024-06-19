<?php
class delete extends controller{

	public function deleteUser($user_id){
		$stmt = $this->delete_user($user_id);
		if($stmt){
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "success";
			$_SESSION['title_alert'] = "Successfully Deleted";
			ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
		}
	}
}
?>