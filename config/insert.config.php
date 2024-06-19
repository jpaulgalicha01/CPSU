<?php
class insert extends controller {
	public function createAcc($FName,$MName,$LName,$Age,$Birthdate,$CivilStatus,$Brgy,$City,$CompleteAddress,$UserName,$Password,$TypeUser){
		$status;
		$stmt = $this->create_acc($FName,$MName,$LName,$Age,$Birthdate,$CivilStatus,$Brgy,$City,$CompleteAddress,$UserName,$Password,$TypeUser);

		if($stmt){
			if($stmt !== 1){
				$data = [
					'status' => "302",
					'icon' => 'error',
					'message' => $stmt,
				];

				echo json_encode($data);
				return false;

			}else{
				$data = [
					'status' => 200,
					'redirect' => "login.php",
				];
				echo json_encode($data);
				return false;
			}
			
		}else{
			$data = [
				'status' => 302,
				'icon' => 'error',
				'message' => "Username is already use.",
			];
			echo json_encode($data);
			return false;
		}
	}
}
?>