<?php
class PostFilter {
    private $isValid = true;
    private $dictionary;
    private $inputs = [];
    private $error = [];
    public function __construct($dictionary) {
        $this->dictionary = $dictionary;
    }
    // '_hasError'
    public function check() {
        foreach($this->dictionary as $key=>$value) {
            $this->validate($key, $value);
        }
        if(count($this->error) > 0) {
            $this->error['_hasError'] = true;
            return $this->error;
        } else {
            $this->inputs['_hasError'] = false;
            return $this->inputs;
        }
        reset();
    }
    public function swapDictionary($newDictionary) {
        $this->dictionary = $newDictionary;
    }
    private function reset() {
        $this->isValid = true;
        $this->inputs = [];
        $this->error = [];
    }
    // undefined
    // failed
    private function validate($stringName, $type) {
        $explodedType = explode(";", $type);
        if(strpos($type, 'image') !== false) {
            if(!isset($_FILES[$stringName])) {
                return;
            }
            $min = sanitizeMinInt($explodedType[0], strlen('image'));
            $max = sanitizeMaxInt($explodedType[1]);
            $this->validatePicture($stringName, $min, $max);
        } else {
            if(!isset($_POST[$stringName])) {
                $this->isValid = false;
                $this->error[$stringName] = "undefined";
                return;
            }
            if(strpos($type, 'string') !== false) {
                $min = sanitizeMinInt($explodedType[0], strlen('string'));
                $max = sanitizeMaxInt($explodedType[1]);
                $this->validateString($stringName, $min, $max);
            } else if(strpos($type, 'email') !== false) {
                $min = sanitizeMinInt($explodedType[0], strlen('email'));
                $max = sanitizeMaxInt($explodedType[1]);
                $this->validateEmail($stringName, $min, $max);
            } else if(strpos($type, 'text') !== false) {
                $min = sanitizeMinInt($explodedType[0], strlen('text'));
                $max = sanitizeMaxInt($explodedType[1]);
                $this->validateText($stringName, $min, $max);
            } else {
                $this->isValid = false;
                $this->error[$stringName] = "undefined validate";
            }
        }
        
    }
    private function sanitizeMinInt($value, $length)
    {
        $sub = substr($value, ($length + 1), strlen($value) - ($length + 1));
        return (int)filter_var($sub, FILTER_SANITIZE_NUMBER_INT);
    }
    private function sanitizeMaxInt($value)
    {
        $sub = substr($value, 0, strlen($value) - 1);
        return (int)filter_var($sub, FILTER_SANITIZE_NUMBER_INT);
    }
    // less
    // greater
    private function validateString($stringName, $min, $max) {
        $stringContent = trim($_POST[$stringName]);
        $stringContent = htmlspecialchars($stringContent);
        $isGequal = strlen($stringContent) >= $min;
        $isLequal = strlen($stringContent) <= $max;
        if($isGequal && $isLequal) {
            $this->inputs[$stringName] = $stringContent;
        } else {
            $this->isValid = false;
            if(!$isGequal) {
                $this->error[$stringName] = "less";
            } else {
                $this->error[$stringName] = "greater";
            }
        }
    }
    // less
    // greater
    private function validateText($stringName, $min, $max) {
        $isLequal = strlen($_POST[$stringName]) <= 65535;
        if($isLequal) {
            $this->inputs[$stringName] = $_POST[$stringName];
        } else {
            $this->isValid = false;
            $this->error[$stringName] = "greater";
        }
    }
    // not_mail
    // less
    // greater
    private function validateEmail($stringName, $min, $max) {
        $filteredMail = trim($_POST[$stringName]);
        $filteredMail = filter_var($filteredMail, FILTER_VALIDATE_EMAIL);
        if($filteredMail === FALSE) {
            $this->error[$stringName] = "not_mail";
        } else {
            $isGequal = strlen($filteredMail) >= $min;
            $isLequal = strlen($filteredMail) <= $max;
            if($isGequal && $isLequal && $isGequal) {
                $this->inputs[$stringName] = $filteredMail;
            } else {
                $this->isValid = false;
                if(!$isGequal) {
                    $this->error[$stringName] = "less";
                } else {
                    $this->error[$stringName] = "greater";
                }
            }
        }
    }
    // empty
    // too_big
    // not_image
    private function validatePicture($stringName, $min, $max) {
        if(!empty($_FILES[$stringName]["name"])) {
            // Get file info 
            $fileName = basename($_FILES[$stringName]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $filesize = $_FILES[$stringName]["size"];

            if($filesize > $max) {
                $this->isValid = false;
                $this->error[$stringName] = 'too_big';
                return;
            }
            // Allow certain file formats 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)) {
                $this->inputs[$stringName] = file_get_contents($_FILES[$stringName]['tmp_name']);
            } else {
                $this->isValid = false;
                $this->error[$stringName] = 'not_image';
            }
            return;
        }
    }
}