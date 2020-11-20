<?php
//////////////////////////////////////////////////////////////////////////////////////////////
//
// Module de génération de gestion de téléchargement de fichiers d'image
//
// Auteur : Nicolas Chourot dans le cadre du cours 420-KB9
// Date : 30 octobre 2020
//
//////////////////////////////////////////////////////////////////////////////////////////////
class ImageHelper {
    public $basePath;
    public $defaultImage;

    public function __construct($basePath = 'images', $defaultImage = 'No_image.png') {
        $this->basePath = $basePath;        
        $this->defaultImage = $defaultImage;
    }

    public function getURL($GUID) {
        $url = $this->basePath.'/';
        if (!empty($GUID)) {
            $url.= $GUID.'.png';
        } else {
            $url.= $this->defaultImage;
        }
        return $url;
    }

    public function html_ImageUploader($GUID='', $tooltipMessage = 'Cliquez pour changer la photo...' ) {
        $url = $this->getURL($GUID);
        $html = <<<HTML
            <!-- nécessite le fichier javascript 'imageUpLoader.js' -->
            <img    id='UploadedImage'
                    class='Photo'
                    src='$url'
                    data-toggle='tooltip'
                    data-placement='bottom'
                    title='$tooltipMessage' />
            <input  id='ImageUploader'
                    name='ImageUploader'
                    type='file'
                    style='display:none'
                    accept='image/png,image/jpeg,image/bmp,image/gif'/>
            HTML;
        return $html;
    }

    private function newGUID() {
        $GUID = '';
        do {
            $GUID = com_create_guid();
        } while (file_exists($this->getURL($GUID)));
        return $GUID;
    }

    public function upLoadImage($previousGUID = '') {
        $GUID = '';
        try {
            $fileName = $_FILES['ImageUploader']['tmp_name'];
            $check = false;
            if ($fileName !== "")
                $check = getimagesize($fileName);
            if ($check) {
                $this->removeFile($previousGUID);
                $GUID = $this->newGUID();
                move_uploaded_file($_FILES["ImageUploader"]["tmp_name"], $this->getURL($GUID));
                return $GUID;
            }
        } catch(Exception $e) {

        }
        return $previousGUID;
    }

    public function removeFile($GUID) {
        if (!empty($GUID)) {
            unlink($this->getURL($GUID));
        }    
    }
}

$imageHelper = new ImageHelper();

function imageHelper() {
    global $imageHelper;
    return $imageHelper;
}