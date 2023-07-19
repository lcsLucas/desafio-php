<?php

include_once "functions.php";

if (filter_has_var(INPUT_GET, "user")) {
    $user = filter_input(INPUT_GET, "user", FILTER_SANITIZE_STRING);

    if (!empty($user)) {
        $data = getRepositories($user);
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 2</title>
</head>

<body>

</body>

</html>