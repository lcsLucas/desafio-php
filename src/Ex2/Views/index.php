<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 100%;
            min-height: 100vh;
            padding: 1.5rem 0;
        }

        .container-form {
            box-shadow: 0 0 0 1px #DFDFDF, 0 0 5px #EEE;
            border-radius: .5rem;
            padding: 1.5rem 2rem;
            max-width: 550px;
            width: 100%;
            flex: 0;
        }

        .form-label {
            text-transform: uppercase;
            font-weight: 500;
            font-size: .8rem
        }

        .form-control::placeholder {
            font-size: 1.1rem;
            color: #999;
        }

        .container-result {
            display: flex;
            padding: 1rem 1.5rem;
            margin: 0 0;
            width: 100%;
        }

        .container-profile {
            display: flex;
            flex-direction: column;
            flex: 1;
            margin-left: 3rem;
            overflow: auto;
        }

        .container-profile h2 {
            text-transform: capitalize;
        }

        .profile-avatar {
            max-width: 70px;
            border-radius: 50%;
            object-fit: cover;
        }

        .container-repo {
            margin: 0 0 1rem;
            border: 1px solid #E1E1E1;
            padding: .75rem;
            border-radius: .35rem
        }

        .container-repo a {
            text-decoration: none;
            color: #434343;
        }

        .container-status {
            display: flex;
            align-items: center;
        }

        .container-status>span {
            margin-right: .75rem;
        }

        .container-status svg {
            width: 1em;
            height: 1em;
        }
    </style>
</head>

<body>

    <div class="container-form">

        <?php
        if (!empty($error)) {
            ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
            <?php
        }
        ?>

        <form action="" method="get">
            <div class="mb-3">
                <label for="nick" class="form-label">Informe Username GitHub:</label>
                <input type="nickname" class="form-control form-control-lg" id="nick" name="username"
                    placeholder="Ex: freeCodeCamp" value="<?= $username ?? '' ?>">
            </div>
            <button type="submit" class="btn btn-primary d-block">Confirmar</button>
        </form>
    </div>

    <?php
    if (!empty($data)) {
        ?>

        <div class="w-100 ps-4">
            <img class="profile-avatar" src="<?= $data['avatar'] ?>" alt="">
        </div>

        <div class="container-result">
            <div>
                <div>
                    <h2>
                        <?= $data['username'] ?>
                    </h2>
                    <p>
                        <?= $data['url'] ?>
                    </p>
                </div>
            </div>
            <div class="container-profile">

                <h2 class="mb-3">Repositórios</h2>
                <?php
                foreach ($data['repos'] as $value) {
                    ?>
                    <div class="container-repo">
                        <div class="d-flex justify-content-between">
                            <span>
                                <a href="<?= $value['html_url'] ?>" target="_blank" rel="noopener noreferrer">
                                    <?= $value['name'] ?>
                                </a>
                            </span>
                            <div>

                                <?php
                                if (!empty($value['language'])) {
                                    ?>
                                    <span class="badge rounded-pill bg-info d-inline-block ms-auto">
                                        <?= $value['language'] ?>
                                    </span>
                                    <?php
                                }
                                ?>

                                <span class="badge rounded-pill bg-success">
                                    <?= $value['visibility'] ?>
                                </span>

                            </div>

                        </div>
                        <div class="container-status">
                            <span>
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512"
                                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M80 104a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm80-24c0 32.8-19.7 61-48 73.3v87.8c18.8-10.9 40.7-17.1 64-17.1h96c35.3 0 64-28.7 64-64v-6.7C307.7 141 288 112.8 288 80c0-44.2 35.8-80 80-80s80 35.8 80 80c0 32.8-19.7 61-48 73.3V160c0 70.7-57.3 128-128 128H176c-35.3 0-64 28.7-64 64v6.7c28.3 12.3 48 40.5 48 73.3c0 44.2-35.8 80-80 80s-80-35.8-80-80c0-32.8 19.7-61 48-73.3V352 153.3C19.7 141 0 112.8 0 80C0 35.8 35.8 0 80 0s80 35.8 80 80zm232 0a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM80 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z">
                                    </path>
                                </svg>
                                <?= $value['default_branch'] ?>
                            </span>
                            <span>
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                    <path
                                        d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83a.996.996 0 000-1.41z">
                                    </path>
                                </svg>
                                <?= date('d/m/Y H:i', strtotime($value['created_at'])) ?>
                            </span>
                            <span>
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="none" stroke="#000" stroke-width="2"
                                        d="M1.7507,16.0022 C3.3517,20.0982 7.3367,23.0002 11.9997,23.0002 C18.0747,23.0002 22.9997,18.0752 22.9997,12.0002 M22.2497,7.9982 C20.6487,3.9012 16.6627,1.0002 11.9997,1.0002 C5.9247,1.0002 0.9997,5.9252 0.9997,12.0002 M8.9997,16.0002 L0.9997,16.0002 L0.9997,24.0002 M22.9997,0.0002 L22.9997,8.0002 L14.9997,8.0002">
                                    </path>
                                </svg>
                                <?= date('d/m/Y H:i', strtotime($value['updated_at'])) ?>
                            </span>
                            <span>
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em"
                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z">
                                    </path>
                                </svg>
                                <?= $value['stargazers_count'] ?>
                            </span>
                            <span>
                                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16"
                                    data-view-component="true" class="octicon octicon-eye mr-2">
                                    <path
                                        d="M8 2c1.981 0 3.671.992 4.933 2.078 1.27 1.091 2.187 2.345 2.637 3.023a1.62 1.62 0 0 1 0 1.798c-.45.678-1.367 1.932-2.637 3.023C11.67 13.008 9.981 14 8 14c-1.981 0-3.671-.992-4.933-2.078C1.797 10.83.88 9.576.43 8.898a1.62 1.62 0 0 1 0-1.798c.45-.677 1.367-1.931 2.637-3.022C4.33 2.992 6.019 2 8 2ZM1.679 7.932a.12.12 0 0 0 0 .136c.411.622 1.241 1.75 2.366 2.717C5.176 11.758 6.527 12.5 8 12.5c1.473 0 2.825-.742 3.955-1.715 1.124-.967 1.954-2.096 2.366-2.717a.12.12 0 0 0 0-.136c-.412-.621-1.242-1.75-2.366-2.717C10.824 4.242 9.473 3.5 8 3.5c-1.473 0-2.825.742-3.955 1.715-1.124.967-1.954 2.096-2.366 2.717ZM8 10a2 2 0 1 1-.001-3.999A2 2 0 0 1 8 10Z">
                                    </path>
                                </svg>
                                <?= $value['watchers_count'] ?>
                            </span>

                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <?php
    }
    ?>
</body>

</html>