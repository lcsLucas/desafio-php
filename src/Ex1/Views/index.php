<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
        }

        .nav-tabs {
            /* background-color: #EEE; */
            margin-bottom: 0;
        }

        .nav-tabs .nav-link {
            padding: 1rem 2rem;
        }

        .tab-content {
            border: 1px solid #EEE;
            border-top: none;
            padding: 3.5rem 2.5rem;
        }

        .form-control {
            padding: 1rem 0.75rem;
            line-height: 1.5;
        }

        .btn {
            display: block;
            width: 100%;
            padding: .85rem 1rem;
            font-size: 1.15rem;
            font-weight: 500;
            letter-spacing: .025rem;
        }
    </style>

</head>

<body>

    <div class="container">

        <?php
        if (!empty($this->getError())) {
            ?>
            <div class="alert alert-danger">
                <?= $this->getError() ?>
            </div>
            <?php
        }
        ?>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link <?= empty($this->getTab()) ? 'active' : '' ?>" id="home-tab"
                    data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home"
                    aria-selected="true">Login</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?= !empty($this->getTab()) ? 'active' : '' ?>" id="profile-tab"
                    data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Cadastrar-se</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade <?= empty($this->getTab()) ? 'show active' : '' ?>" id="home" role="tabpanel"
                aria-labelledby="home-tab">

                <form method="post" action="">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                            placeholder="name@example.com" name="email" required
                            value="<?= $this->getModel()->getEmail() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Senha</label>
                        <input type="password" class="form-control" id="inputPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5" name="login">Login</button>
                </form>
            </div>
            <div class="tab-pane fade <?= !empty($this->getTab()) ? 'show active' : '' ?>" id="profile" role="tabpanel"
                aria-labelledby="profile-tab">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="inputName2" class="col-sm-2 col-form-label">Nome</label>
                        <input type="text" class="form-control" id="inputName2" name="name" required minlength="3"
                            value="<?= $this->getModel()->getName() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleFormControlInput2"
                            placeholder="name@example.com" name="email" required
                            value="<?= $this->getModel()->getEmail() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword2" class="col-sm-2 col-form-label">Senha</label>
                        <input type="password" class="form-control" id="inputPassword2" name="password" required
                            minlength="7">
                    </div>
                    <button type="submit" class="btn btn-primary mt-5" name="signup">Cadastrar</button>
                </form>
            </div>
        </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>

</html>