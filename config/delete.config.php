<?php

class delete extends controller
{

    public function deleteImg($imgRowNum, $servicesName)
    {
        $stmt = $this->delete_img($imgRowNum, $servicesName);

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
}
