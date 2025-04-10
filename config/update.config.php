<?php
class update extends controller
{
	// ------------------------- Admin Side -------------------------//
	public function updateBooking($ClientUserID, $status, $itemNo)
	{
		$stmt = $this->update_booking($ClientUserID, $status, $itemNo);

		if (!$stmt) {
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Somthing Wrong. Please try againg";
			ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
		}
		if ($stmt !== 1) {
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = $stmt;
			ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
		}
		$_SESSION['alert'] = "Show";
		$_SESSION['icon'] = "success";
		$_SESSION['title_alert'] = "Successfully Updated";
		ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
	}

	public function changeProfImg()
	{
		$stmt = $this->change_prof_img();

		if ($stmt) {
			if ($stmt !== 1) {
				$_SESSION['alert'] = "Show";
				$_SESSION['icon'] = "error";
				$_SESSION['title_alert'] = $stmt;
				ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
			} else {
				$_SESSION['alert'] = "Show";
				$_SESSION['icon'] = "success";
				$_SESSION['title_alert'] = "Successfully Updated";
				ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
			}
		} else {
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Somthing Wrong. Please try againg";
			ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
		}
	}

	// public function updateInfo($acc_fname, $acc_mname, $acc_lname, $acc_address, $acc_birth, $acc_phone, $acc_email, $acc_uname, $curr_pass, $new_pass)
	// {
	// 	$stmt = $this->update_info($acc_fname, $acc_mname, $acc_lname, $acc_address, $acc_birth, $acc_phone, $acc_email, $acc_uname, $curr_pass, $new_pass);

	// 	if (!$stmt) {
	// 		$_SESSION['alert'] = "Show";
	// 		$_SESSION['icon'] = "error";
	// 		$_SESSION['title_alert'] = "There's Somthing Wrong. Please try againg";
	// 		ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
	// 	} else {
	// 		switch ($stmt) {
	// 			case '1':
	// 				$_SESSION['alert'] = "Show";
	// 				$_SESSION['icon'] = "success";
	// 				$_SESSION['title_alert'] = "Successfully Updated";
	// 				ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
	// 				break;

	// 			default:
	// 				$_SESSION['alert'] = "Show";
	// 				$_SESSION['icon'] = "error";
	// 				$_SESSION['title_alert'] = $stmt;
	// 				ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
	// 				break;
	// 		}
	// 	}
	// }
	// ------------------------- Admin Side -------------------------//

	// ------------------------- Artist Side -------------------------//

	public function editservices($servicesID, $prevServicesName, $prevServicesCatInput, $editServiceCatNo, $editServicePrice, $editServicesName, $editServicesPolicy)
	{
		$stmt = $this->edit_services($servicesID, $prevServicesName, $prevServicesCatInput, $editServiceCatNo, $editServicePrice, $editServicesName, $editServicesPolicy);

		if (!$stmt) {
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Somthing Wrong. Please try again";
			ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
		}
		if ($stmt !== 1) {
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = $stmt;
			ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
		}
		$_SESSION['alert'] = "Show";
		$_SESSION['icon'] = "success";
		$_SESSION['title_alert'] = "Successfully Updated";
		ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
	}


	public function updateInfo($FName, $MName, $LName, $UserName, $OPass, $NPAss)
	{
		$stmt = $this->update_info($FName, $MName, $LName, $UserName, $OPass, $NPAss);

		if (!$stmt) {
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's Somthing Wrong. Please try againg";
			ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
		} else {
			switch ($stmt) {
				case '1':
					$_SESSION['alert'] = "Show";
					$_SESSION['icon'] = "success";
					$_SESSION['title_alert'] = "Successfully Updated";
					ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
					break;

				default:
					$_SESSION['alert'] = "Show";
					$_SESSION['icon'] = "error";
					$_SESSION['title_alert'] = $stmt;
					ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
					break;
			}
		}
	}

	// ------------------------- Artist Side -------------------------//



	public function checkingBooking()
	{
		$stmt = $this->checking_booking();
		return $stmt;
	}


	public function CancelledBooking($bookingID)
	{

		$stmt = $this->cancelled_booking($bookingID);
		if ($stmt) {
			$data = [
				'status' => 200,
				`message` => "Success Update Data"
			];
			echo json_encode($data);
			return false;
		} else {
			$data = [
				'status' => 500,
				`message` => "Failed To Update Data"
			];
			echo json_encode($data);
			return false;
		}
	}
}
