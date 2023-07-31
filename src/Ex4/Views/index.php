<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout da Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .container label {
            cursor: pointer;
        }
    </style>

</head>

<body>

    <div class="container">

        <h1 class="text-center mt-5 mb-5">Checkout da Compra</h1>

        <form style="max-width: 700px;" class="mx-auto" action="" method="post">
            <div class="list-group">
                <label class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <input required class="form-check-input me-1" type="radio" name="type" value="credit"
                                id="firstRadio">
                            Cartão de Crédito
                        </h5>
                        <small>Até 3x sem juros.</small>
                    </div>
                    <p class="mb-1">Pague com as principais bandeiras do mercado.</p>
                    <small>Lorem ipsum dolor sit amet consectetur.</small>
                </label>
                <label class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <input required class="form-check-input me-1" type="radio" name="type" value="debit"
                                id="secondRadio">
                            Débito Online
                        </h5>
                        <small class="text-body-secondary">Pagamento confirmado na hora.</small>
                    </div>
                    <p class="mb-1">Pague com o seu cartão de débito sem complicações.</p>
                    <small>Lorem ipsum dolor sit amet consectetur.</small>
                </label>
                <label class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <input required class="form-check-input me-1" type="radio" name="type" value="boleto"
                                id="thirdRadio">
                            Boleto
                        </h5>
                        <small class="text-body-secondary">Confirmado em até 3 dias úteis.</small>
                    </div>
                    <p class="mb-1">Gere o boleto com apenas alguns cliques, simples e rápido.</p>
                    <small>Lorem ipsum dolor sit amet consectetur.</small>
                </label>
            </div>

            <div class="text-center">
                <button class="btn btn-lg btn-success px-5 mt-5" type="submit">Confirmar</button>
            </div>

        </form>
    </div>


</body>

</html>