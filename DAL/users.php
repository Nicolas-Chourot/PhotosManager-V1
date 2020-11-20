<?php
include_once "MySQLDBA.php";
include_once "MyAppDB.php";
include_once "utilities/imageHelper.php";
final class Users extends MySQLTable {
    // Énumération des champs de la table
    public $Id;
    /** VARCHAR(64) */
    public $Name;
    /** VARCHAR(128) */
    public $Email;
    public $Password;
    public $Admin;
    public $AvatarGUID;
    public $CreationDate;
    public $_imageHelper;

    // Méthode abstraite: reféfinition obligatoire
    // Cette méthode permettra à la classe parente
    // de déterminer le type SQL pour chacune des
    // propriétés dont l'identificateur ne commence
    // pas le le caractère _
    public function init() {
        $this->Id = 0;          
        $this->Name = '';
        $this->Email = '';
        $this->Admin = false;
        $this->Password = '';
        $this->CreationDate = date("Y-m-d H:i:s");
        $this->AvatarGUID = '';

        $this->_imageHelper = new ImageHelper('images/avatars','NoPhoto.png');
    }
    public function getAvatarURL($avatarGUID) {
        return $this->_imageHelper->getURL($avatarGUID);
    }
    public function html_AvatarUploader($avatarGUID = '') {
        return $this->_imageHelper->html_ImageUploader($avatarGUID, 'Cliquez pour sélectionner votre avatar...');
    }
    public function uploadAvatar($avatarGUID='') {
        return $this->_imageHelper->uploadImage($avatarGUID);
    }
    public function removeAvatar($avatarGUID) {
        $this->_imageHelper->removeFile($avatarGUID);
    }
    public function emailExist($email){
        $user = $this->selectWhere("Email = '$email'");
        return isset($user[0]);
    }
    public function findByEmail($email){
        $user = $this->selectWhere("Email = '$email'");
        if (isset($user[0]))
            return $user[0];
        return null;
    }
    public function userValid($email, $password){
        $user = $this->selectWhere("Email = '$email'");
        if (isset($user[0])) {
            return password_verify($password, $user[0]["Password"]);
        }
        return false;
    }
    public function register($userData) {
        if (!$this->emailExist($userData["Email"])) {
            $userData["Admin"] = 0; // false
            $userData["CreationDate"] = date("Y-m-d H:i:s");
            $userData["AvatarGUID"] = $this->uploadAvatar();
            $this->insert($userData);
            return true;
        }
        return false;
    }
    public function changeProfil($userData) {
        $foundUser = $this->findByEmail($userData["Email"]);
        if ($foundUser) {
            if ($foundUser["Id"] != $userData["Id"])
                // conflit de courriel
                return null;
        }
        $userToUpdate = $this->get($userData["Id"]);
        if ($userToUpdate) {
            $userToUpdate["Name"] = $userData["Name"];
            $userToUpdate["Email"] = $userData["Email"];        
            $userToUpdate["AvatarGUID"] = $this->uploadAvatar($userData["AvatarGUID"]);

            if ($userData["Password"] != "") {
                $userToUpdate["Password"] = $userData["Password"];
                $this->update_Including_Password($userToUpdate);
            }
            else {
                $this->update($userToUpdate);
            }
            return $userToUpdate;
        }
        return null;
    }
    function deleteUser($id) {
        $userToDelete = $this->get($id);
        if ($userToDelete) {
            TableUsers()->removeAvatar($userToDelete["AvatarGUID"]);
            TableUsers()->delete($id);
        }
    }
    function userList() {
        return $this->selectAll("ORDER BY Name");
    }

    private static $_instance = null;
    public static function getInstance($dataBaseAccess) {
        if(is_null(self::$_instance)) {
            $calledClass = get_called_class();
            self::$_instance = new $calledClass($dataBaseAccess);  
        }
        return self::$_instance;
    }
}

function TableUsers() {
    return Users::getInstance(DB());
}

TableUsers();
?>