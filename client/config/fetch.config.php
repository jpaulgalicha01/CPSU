<?php

class fetch extends controller {
    
    public function fetchInfoUser($UserID){
		$stmt = $this->fetch_info_user($UserID);
		return $stmt;
	}


    public function fetchClientArtist($TypeUser){
		$stmt = $this->fetch_client_artist($TypeUser);
		return $stmt;
	}

    public function viewUser($user_id){
		$stmt = $this->view_user($user_id);

		if($stmt->rowCount()){
			$fetch_info = $stmt->fetch();

			$data = [
				'status' => 200,
				'data' => $fetch_info,
			];
			echo json_encode($data);
			return false;
		}else{
			return false;
		}
	}

    public function countUser($TypeUser,$Status){
		$stmt = $this->count_user($TypeUser,$Status);
		if($stmt->rowCount()){
			echo $stmt->rowCount();
		}else{
			echo "0";
		}
	}

}