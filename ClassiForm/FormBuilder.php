<?php
// Classe che ci permetterà di creare un form in base alle specifiche all'interno dei file in ./config/form
class FormBuilder
{
    protected array $formAttribute;
    protected array $fields;
    protected string $htmlCode = '';

    
    public function build(array $formAttribute, array $fields): string
    {
        $this->formAttribute = $formAttribute;
        $this->fields = $fields;
        $this->startForm()->buildFields()->endForm();
        return $this->htmlCode;
    }

    protected function startForm(): FormBuilder
    {
        $this->htmlCode .= "
        <form class='row g-3 justify-content-center' action='{$this->formAttribute['action']}' name='{$this->formAttribute['name']}' method='{$this->formAttribute['method']}'>
        ";
        return $this;
    }

    protected function buildFields(): FormBuilder
    {
        foreach ($this->fields as $fieldName => $fieldValue) {
            $this->htmlCode .= match ($fieldValue['attribute']['type']) {
                'text' => $this->inputField($fieldName, $fieldValue),
                'email' => $this->inputField($fieldName, $fieldValue),
                'password' => $this->inputField($fieldName, $fieldValue),
            };
        }
        return $this;
    }

    protected function inputField(string $fieldName, array $fieldValue): string
    {
        $fva = $fieldValue['attribute'];

        // Stampa degli errori
        $errors = $this->fields[$fieldName]['errors'];
        $error = '';
        foreach($errors as $err) {
            $error .= $err;
        }

        // Set label
        $label = ucfirst($fieldName);

        // Set classe is-invalid
        $is_invalid = '';
        if ($error) {
            $is_invalid = 'is-invalid';
        }
        
        $input = "
        <div class='col-md-8'>
        <label for='{$fieldName}' class='form-label'>{$label}</label>
        <input class='form-control {$is_invalid}' type='{$fva['type']}' name='{$fva['name']}' placeholder='{$fva['placeholder']}' value='{$fva['value']}' id='{$fieldName}'>
        <div id='{$fieldName}' class='invalid-feedback'>
        $error
        </div>
        </div>
        ";
        return $input;
    }

    protected function endForm(): FormBuilder
    {
        $this->htmlCode .= "
        <div class='d-flex justify-content-center'>
        <button class='btn btn-primary' type='submit'>Invia</button>
        </div>
        </form>";
        return $this;
    }
}
