<?php

class fetch extends controller {
    
	public function fetchInfoUser($UserID){
		$stmt = $this->fetch_info_user($UserID);
		return $stmt;
	}

	public function ServicesList(){
		$stmt = $this->services_list();
		return $stmt;
	}

	public function ServicesFetchId($ServicesId){
		$stmt = $this->Services_fetch_id($ServicesId);
		
		if($stmt){
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
		else{
			
			$data = [
				'status' => 500,
				'message' => "There's something wrong.",
			];
			echo json_encode($data);
			return false;
		}
	}


	public function fetchProfImg(){
		$stmt = $this->fetch_prof_img();
		return $stmt;
	}

	public function fetchDescription(){
		$stmt = $this->fetch_description();
		return $stmt;
	}

	public function DescriptionFetchID($DescriptionID){
		$stmt = $this->description_fetch_id($DescriptionID);
		if($stmt){
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
		else{
			
			$data = [
				'status' => 500,
				'message' => "There's something wrong.",
			];
			echo json_encode($data);
			return false;
		}
	}

}