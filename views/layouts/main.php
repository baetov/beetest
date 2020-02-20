<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<header>


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="/">задачник</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>

            </ul>
            <span class="navbar-text">

    </span>
        </div>

        <? if ($auth) : ?>
            <span class="navbar">Добро пожаловать: <?= $username ?></span>
            <a class="btn btn-secondary" href="/auth/logout/">выход</a>

        <? else: ?>
            <form action="/auth/login/" method="post">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="text" name="login" class="form-control mb-2" id="inlineFormInput"
                               placeholder="Логин">
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input type="password" name="pass" class="form-control" id="inlineFormInputGroup"
                                   placeholder="Пароль">
                        </div>
                    </div>
                    <div class="col-auto">
                    </div>
                    <div class="col-auto">
                        <button id="login" type="submit" class="btn btn-primary mb-2">Войти</button>
                    </div>
                </div>
            </form>
        <? endif; ?>
    </nav>

        <?
//                var_dump($_SESSION);
        $sessionMessage = implode($_SESSION);
        $key = implode(array_keys($_SESSION));
        if ($key == 'alert' or $key == 'wrong' or $key == 'error'){
            echo "
         <div class=\"alert alert-danger allert-dissmissable\" role=\"alert\">{$sessionMessage}
            <button id='close' type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
         </div>
        ";
        }
        if ($key== 'sucess'){
            echo "
         <div class=\"alert alert alert-success allert-dissmissable\" role=\"alert\">{$sessionMessage}
            <button id='close' type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
         </div>
        ";
        }

        ?>




    <?= $content; ?>

    <script>
        $(document).ready(function () {
            $('#close').click(function(){
                $.ajax({
                    url: '/tasks/destroymessage',
                    success: function(){
                        console.log('успех');
                    }
                });
            });
        });
    </script>
</body>
</html>

