<?php
include(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__DIR__) . "../lib/database.php");
require_once(dirname(__DIR__) . '../models/setting.model.php');

class SettingsController {
    private $db;
    private $settingsModel;

    public function __construct() {
        $this->db = new Database();
        $this->settingsModel = new SettingsModel($this->db);
    }

    public function getStoreInfo() {
        return $this->settingsModel->getStoreInfo();
    }

    public function updateStoreInfo($data) {
        return $this->settingsModel->updateStoreInfo($data);
    }

    public function getSettings(){
        return $this->settingsModel->getAllSettings();
    }


    public function updateSettings($data)
    {
        return $this->settingsModel->updateSettings($data);
    }
}
