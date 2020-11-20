<?php
include_once "MySQLDBA.php";
include_once "MyAppDB.php";
include_once "utilities/imageHelper.php";
final class Photos extends MySQLTable {
    public $Id;
    /** VARCHAR(32) */
    public $Title;
    /** VARCHAR(256) */
    public $Description;
    /** VARCHAR(128) */
    public $Keywords;

    public $CreationDate;
    public $UserId;
    public $Shared;
    public $GUID;

    public function init() {
        $this->Id = 0;          
        $this->Title = '';
        $this->Description = '';
        $this->Keywords = '';
        $this->GUID = ''; 

        $this->UserId = 0; 
        $this->Shared = true;
        $this->CreationDate = date("Y-m-d H:i:s");   
        $this->_imageHelper = new ImageHelper('images/photos', 'No_image.png');
    }    
    public function getPhotoURL($photoGUID) {
        return $this->_imageHelper->getURL($photoGUID);
    }
    public function html_PhotoUploader($photoGUID = '') {
        return $this->_imageHelper->html_ImageUploader($photoGUID, "Cliquez pour sélectionner l'image...");
    }
    public function uploadPhoto($photoGUID='') {
        return $this->_imageHelper->uploadImage($photoGUID);
    }
    public function removePhoto($photoGUID) {
        $this->_imageHelper->removeFile($photoGUID);
    }
    function deletePhoto($id) {
        $photoToDelete = $this->get($id);
        if ($photoToDelete) {
            $this->removePhoto($photoToDelete["GUID"]);
            $this->delete($id);
        }
    }
    public function add($photoData) {
            $photoData["Id"]= 0;
            $photoData["UserId"] = $_SESSION["loggedUser"]["Id"];
            $photoData["Keywords"] = "";
            $photoData["Shared"] = 0; // false
            $photoData["CreationDate"] = date("Y-m-d H:i:s");
            $photoData["GUID"] = $this->uploadPhoto();
            $this->insert($photoData);
            return true;
    }  
    public function updatePhoto($photoData) {
        if ($this->get($photoData["Id"])) {        
            $photoData["GUID"] = $this->uploadPhoto($photoData["GUID"]);
            $this->update($photoData);
        }
    } 
    function list() {
        return $this->selectAll("ORDER BY Title");
    }
    
    /// Cette portion ajoute la fonctionnalité "Singleton"//////
    private static $_instance = null;
    public static function getInstance($dataBaseAccess) {
        if(is_null(self::$_instance)) {
            $calledClass = get_called_class();
            self::$_instance = new $calledClass($dataBaseAccess);  
        }
        return self::$_instance;
    }
    ///////////////////////////////////////////////////////////
}

function TablePhotos() {
    return Photos::getInstance(DB());
}
TablePhotos();
?>