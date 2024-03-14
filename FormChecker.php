<?php
// Classe che andrà a validare il form al submit
class FormChecker {

    protected array $data = [];
    protected array $fields;
    protected bool $validated = true;

    // Ricevo la request
    public function __construct() {
        $this->data = $_POST;
    }
 
    // Effettuo le validazioni lavorando su una copia del parametro
    public function validate(array &$fields): bool {
        $this->fields = &$fields;
        foreach($this->fields as $fieldName => $fieldInfo) {
            foreach($fieldInfo['rules'] as $ruleType => $ruleValue) {
                match($ruleType) {
                    'required' => $this->checkRequire($fieldName, $ruleValue),
                    'email' => $this->checkEmail($fieldName, $ruleValue),
                    'min' => $this->checkMin($fieldName, $ruleValue),
                    'password' => $this->checkPassword($fieldName, $ruleValue)
                };
            }
        }
        return $this->validated;
    }

    // Assegno un messaggio per gli errori
    protected function checkRequire(string $fieldName, mixed $ruleValue) {
        if(mb_strlen(trim($this->data[$fieldName])) === 0) {
            $this->setError($fieldName, 'Campo richiesto.<br>');
        }
    }
    protected function checkEmail(string $fieldName, mixed $ruleValue) {
        if(!filter_var($this->data[$fieldName], FILTER_VALIDATE_EMAIL)) {
            $this->setError($fieldName, 'Inserire una email valida.<br>');
        }
    }
    protected function checkMin(string $fieldName, mixed $ruleValue) {
        if(mb_strlen(trim($this->data[$fieldName])) < $ruleValue) {
            $this->setError($fieldName, "Il campo deve essere compilato con almeno $ruleValue caratteri.<br>");
        }
    }

    protected function checkPassword(string $fieldName, mixed $ruleValue) {
        if(mb_strlen(trim($this->data[$fieldName])) < $ruleValue) {
            $this->setError($fieldName, "Il campo deve essere compilato con almeno $ruleValue caratteri.<br>");
        }
        if (!preg_match("/[A-Z]/", $this->data[$fieldName])) {
            $this->setError($fieldName, "La password deve contenere almeno una lettera maiuscola.<br>");
        }
        if (!preg_match("/[a-z]/", $this->data[$fieldName])) {
            $this->setError($fieldName, "La password deve contenere almeno una lettera minuscola.<br>");
        }
        if (!preg_match("/\W/", $this->data[$fieldName])) {
            $this->setError($fieldName, "La password deve contenere almeno un carattere speciale.<br>");
        }
        if (preg_match("/\s/", $this->data[$fieldName])) {
            $this->setError($fieldName, "La password non può contenere spazi.<br>");
        }
    }

    protected function setError(string $fieldName, string $error) {
        $this->validated = false;
        array_push($this->fields[$fieldName]['errors'], $error);
    }
}