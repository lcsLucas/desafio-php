<?php
include_once __DIR__ . '/paginate.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .list-group {
            max-width: 600px;
            margin: 2rem auto 0;
        }

        .list-group-item {
            padding: 1.25rem 1rem
        }

        .list-group-item.active {
            pointer-events: none;
        }

        .list-group-item.disabled {
            background: green;
            color: white;
            position: relative;
        }

        .list-group-item.disabled svg {
            position: absolute;
            right: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.75rem;
        }
    </style>
</head>

<body>

    <form action="" method="get">
        <div class="list-group">

            <?php
            if (!empty($error)) {
                ?>
                <div class="alert alert-danger">
                    <?= $error ?>.
                    <strong class="d-block mt-2">
                        Para verificar todas as informações consulte o arquivo de log (
                        <?= ABSPATH ?>/.data/
                        <?= DIR ?>/error-etl.log).
                    </strong>
                </div>
                <?php
            } else if (!empty($success)) {
                ?>
                    <div class="alert alert-success">
                    <?= $success ?>
                    </div>
                    <?php
            }
            ?>

            <p>Escolha uma opção abaixo:</p>

            <button name="option" value="etl"
                class="list-group-item list-group-item-action <?= $option === "etl" ? 'active' : '' ?> <?= !empty($_SESSION["etl"]) ? 'disabled' : '' ?>"
                style="border-top-right-radius: inherit; border-top-left-radius: inherit;">
                Extrair, Transformar e Carregar os Dados da Fonte

                <?php
                if (!empty($_SESSION["etl"])) {
                    ?>
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em"
                        width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M170.718 216.482L141.6 245.6l93.6 93.6 208-208-29.118-29.118L235.2 279.918l-64.482-63.436zM422.4 256c0 91.518-74.883 166.4-166.4 166.4S89.6 347.518 89.6 256 164.482 89.6 256 89.6c15.6 0 31.2 2.082 45.764 6.241L334 63.6C310.082 53.2 284.082 48 256 48 141.6 48 48 141.6 48 256s93.6 208 208 208 208-93.6 208-208h-41.6z">
                        </path>
                    </svg>
                    <?php
                }
                ?>


            </button>
            <button name="option" value="query1"
                class="list-group-item list-group-item-action <?= $option === "query1" ? 'active' : '' ?>">
                Organizações com mais de 5000 funcionários ordenadas por nome.
            </button>
            <button name="option" value="query2"
                class="list-group-item list-group-item-action <?= $option === "query2" ? 'active' : '' ?>">
                Organizações fundadas antes dos anos 2000 com menos de 1000 funcionários ordenadas por data de fundação.
            </button>
            <button name="option" value="query3"
                class="list-group-item list-group-item-action <?= $option === "query3" ? 'active' : '' ?>">
                Quantidade organizações e funcionários, agrupados por indústria e pais, e ordenadas por industria.
            </button>
        </div>
    </form>

    <?php
    if (!empty($data)) {
        ?>
        <div class="mt-5 container">

            <h4 class="mt-5 mb-4 text-center">
                <?php
                switch ($option) {
                    case 'query1':
                        echo "Organizações com mais de 5000 funcionários ordenadas por nome";
                        break;
                    case 'query2':
                        echo "Organizações fundadas antes dos anos 2000 com menos de 1000 funcionários ordenadas por data de fundação";
                        break;
                    case 'query3':
                        echo "Quantidade organizações e funcionários, agrupados por indústria e pais, e ordenadas por industria";
                        break;
                }
                ?>
            </h4>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="<?= $option === "query3" ? "d-none" : "" ?>">Id</th>
                        <th class="<?= $option === "query3" ? "d-none" : "" ?>">Name</th>
                        <th class="<?= $option === "query3" ? "d-none" : "" ?>">Website</th>
                        <th class="">Country</th>
                        <th class="<?= $option === "query3" ? "d-none" : "" ?>">Founded</th>
                        <th class="">Industry</th>
                        <th class="<?= $option !== "query3" ? "d-none" : "text-center" ?>">Count Organizations</th>
                        <th class="text-center">Employees</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $value) {
                        ?>
                        <tr>
                            <td class="<?= $option === "query3" ? "d-none" : "" ?>">
                                <?= $value['id'] ?>
                            </td>
                            <td class="<?= $option === "query3" ? "d-none" : "" ?>">
                                <?= $value['name'] ?>
                            </td>
                            <td class="<?= $option === "query3" ? "d-none" : "" ?>">
                                <?= $value['website'] ?>
                            </td>
                            <td>
                                <?= $value['country'] ?>
                            </td>
                            <td class="<?= $option === "query3" ? "d-none" : "" ?>">
                                <?= $value['founded'] ?>
                            </td>
                            <td>
                                <?= $value['industry'] ?>
                            </td>
                            <td class="<?= $option !== "query3" ? "d-none" : "text-center" ?>">
                                <?= $value['total_organizations'] ?>
                            </td>
                            <td class="text-center">
                                <?= $value['employees'] ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <?php
            paginate($total_registry, $qtde_registry, $current_page, $range_pages, "");
            ?>

        </div>
        <?php
    }
    ?>

</body>

</html>