<?php
class insert extends controller {
    public function insertServices($ServicesName,$ServicePrice){
        $stmt = $this->insert_services($ServicesName,$ServicePrice);

        if($stmt){
			if($stmt !== 1){
                $_SESSION['alert'] = "Show";
                $_SESSION['icon'] = "error";
                $_SESSION['title_alert'] = $stmt;
                ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
			}else{
                $_SESSION['alert'] = "Show";
                $_SESSION['icon'] = "success";
                $_SESSION['title_alert'] = "Successfully";
                ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
			}
		}

    }

    public function addProfileImages(){
        $stmt = $this->add_profile_images();

        if($stmt){
			if($stmt !== 1){
                $_SESSION['alert'] = "Show";
                $_SESSION['icon'] = "error";
                $_SESSION['title_alert'] = $stmt;
                ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
			}else{
                $_SESSION['alert'] = "Show";
                $_SESSION['icon'] = "success";
                $_SESSION['title_alert'] = "Successfully";
                ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
			}
		}else{
            $_SESSION['alert'] = "Show";
            $_SESSION['icon'] = "error";
            $_SESSION['title_alert'] = "There's something error. Please try again";
            ob_end_flush(header("Location: ".$_SERVER['HTTP_REFERER'].""));
        }

    }
}
