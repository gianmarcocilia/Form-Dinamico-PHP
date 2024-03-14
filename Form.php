<?php
// Classe che ci servià per inizializzare un nuovo form
class Form {
    protected array $formAttribute;
    protected array $fields;

    public function __construct(
        protected string $formConfig,
        protected FormBuilder $builder = new FormBuilder,
        protected FormChecker $checker = new FormChecker
    ){
        $this->init()->checkSubmit();
    }

    // Prelevo dinamicamente attributi e fields dal file che passo in index
    private function init(): Form {
        extract(require $this->formConfig);
        $this->formAttribute = $formAttribute;
        $this->fields = $fields;
        return $this;
    }

    private function checkSubmit(): void {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleSubmit();
        }
    }

    private function handleSubmit() {
        // validazione campi con form checker
        if($this->checker->validate($this->fields)) {
            // azione per check valido
        }
        
    }

    // invio attribbuti e fields al form builder e costruisco il form
    public function render(): string {
        // costruzione form con form builder
        $form = $this->builder->build($this->formAttribute, $this->fields);
        return $form;
    }
}