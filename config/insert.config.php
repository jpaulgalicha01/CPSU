<?php
class insert extends controller
{

	// ------------------------- Artist Side -------------------------//
	public function insertServices($ServicesName, $ServicePrice, $ServicesPolicy)
	{
		$stmt = $this->insert_services($ServicesName, $ServicePrice, $ServicesPolicy);

		if ($stmt) {
			if ($stmt !== 1) {
				$_SESSION['alert'] = "Show";
				$_SESSION['icon'] = "error";
				$_SESSION['title_alert'] = $stmt;
				ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
			} else {
				$_SESSION['alert'] = "Show";
				$_SESSION['icon'] = "success";
				$_SESSION['title_alert'] = "Successfully";
				ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
			}
		}
	}

	public function addProfileImages($servicesName)
	{
		$stmt = $this->add_profile_images($servicesName);

		if ($stmt) {
			if ($stmt !== 1) {
				$_SESSION['alert'] = "Show";
				$_SESSION['icon'] = "error";
				$_SESSION['title_alert'] = $stmt;
				ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
			} else {
				$_SESSION['alert'] = "Show";
				$_SESSION['icon'] = "success";
				$_SESSION['title_alert'] = "Successfully";
				ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
			}
		} else {
			$_SESSION['alert'] = "Show";
			$_SESSION['icon'] = "error";
			$_SESSION['title_alert'] = "There's something error. Please try again";
			ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
		}
	}

	// public function addDescription($description)
	// {
	// 	$stmt = $this->add_description($description);

	// 	if ($stmt) {
	// 		if ($stmt !== 1) {
	// 			$_SESSION['alert'] = "Show";
	// 			$_SESSION['icon'] = "error";
	// 			$_SESSION['title_alert'] = $stmt;
	// 			ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
	// 		} else {
	// 			$_SESSION['alert'] = "Show";
	// 			$_SESSION['icon'] = "success";
	// 			$_SESSION['title_alert'] = "Successfully";
	// 			ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
	// 		}
	// 	} else {
	// 		$_SESSION['alert'] = "Show";
	// 		$_SESSION['icon'] = "error";
	// 		$_SESSION['title_alert'] = "There's something error. Please try again";
	// 		ob_end_flush(header("Location: " . $_SERVER['HTTP_REFERER'] . ""));
	// 	}
	// }

	public function insertDateSched($selectedDates)
	{
		$stmt = $this->insert_date_sched($selectedDates);
		if ($stmt) {

			$data = [
				'status' => 200,
				'icon' => 'success',
				'message' => "Successfully Save",
			];
			echo json_encode($data);
			return false;
		} else {
			$data = [
				'status' => 500,
				'icon' => 'error',
				'message' => "Internal Server Error",
			];
			echo json_encode($data);
			return false;
		}
	}

	// ------------------------- Artist Side -------------------------//


	// ------------------------- Client Side -------------------------//
	public function createAcc($FName, $MName, $LName, $Age, $Birthdate, $CivilStatus, $Brgy, $City, $CompleteAddress, $ContactNumber, $UserName, $Password, $TypeUser)
	{
		$stmt = $this->create_acc($FName, $MName, $LName, $Age, $Birthdate, $CivilStatus, $Brgy, $City, $CompleteAddress, $ContactNumber, $UserName, $Password, $TypeUser);
		if ($stmt) {
			if ($stmt !== 1) {
				$data = [
					'status' => "302",
					'icon' => 'error',
					'message' => $stmt,
				];

				echo json_encode($data);
				return false;
			} else {
				$data = [
					'status' => 200,
					'redirect' => "login.php",
				];
				echo json_encode($data);
				return false;
			}
		} else {
			$data = [
				'status' => 302,
				'icon' => 'error',
				'message' => "Username is already use.",
			];
			echo json_encode($data);
			return false;
		}
	}

	public function clientBooking($ArtistUserID, $UserID, $Address, $Services, $TypeServices, $Date, $Time, $SampleOutcome)
	{
		$stmt = $this->client_booking($ArtistUserID, $UserID, $Address, $Services, $TypeServices, $Date, $Time, $SampleOutcome);

		if ($stmt) {
			if ($stmt !== 1) {
				$data = [
					'status' => 302,
					'icon' => 'error',
					'message' => $stmt,
				];
				echo json_encode($data);
				return false;
			} else {
				$data = [
					'status' => 200,
					'icon' => 'success',
				];
				echo json_encode($data);
				return false;
			}
		} else {
			$data = [
				'status' => 500,
				'icon' => 'error',
				'message' => "There's Something Wrong Please Try Again.",
			];
			echo json_encode($data);
			return false;
		}
	}
	// ------------------------- Client Side -------------------------//
}
