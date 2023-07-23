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
    </style>
</head>

<body>

    <form action="" method="get">
        <div class="list-group">
            <p>Escolha uma opção abaixo:</p>

            <button name="option" value="etl"
                class="list-group-item list-group-item-action <?= $option === "etl" ? 'active' : '' ?>"
                style="border-top-right-radius: inherit; border-top-left-radius: inherit;">
                Extrair, Transformar e Carregar os Dados da Fonte
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
                Quantidade organizações e funcionários, agrupados por insdustria e pais, e ordenadas por industria.
            </button>
        </div>
    </form>

</body>

</html>