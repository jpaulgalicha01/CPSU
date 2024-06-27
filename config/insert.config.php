<?php
class insert extends controller
{
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

	public function clientBooking($ArtistUserID, $UserID, $Address, $Services, $SampleOutcome)
	{
		$stmt = $this->client_booking($ArtistUserID, $UserID, $Address, $Services, $SampleOutcome);

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
}