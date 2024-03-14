<?php
session_start();
require __DIR__ . './ClassiForm/Form.php';
require __DIR__ . './ClassiForm/FormBuilder.php';
require __DIR__ . './ClassiForm/FormChecker.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Dinamico - PHP</title>
    <!-- BOOTSTRAP LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2 class="text-center py-3">Registrati</h2>
        <?php
        $form = new Form(__DIR__ . './php/form/register.php');
        echo $form->render();
        ?>
    </div>
</body>

</html>