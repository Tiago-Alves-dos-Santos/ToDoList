<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/favicon/list.ico') }}">
    <title>Confirmar email</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #66396E;
            font-family: 'Roboto', sans-serif;
            overflow-x: hidden;
        }

        div {
            box-sizing: border-box;
        }

        .w-100 {
            width: 100%;
        }

        .bolder {
            font-weight: bolder;
        }

        .flex-center {
            display: flex;
            justify-content: center;
        }
        .btn-primary{
            text-decoration: none;
            border: none;
            background-color: #66396E;
            color:#fff;
            border-radius: 30px;
            padding: 10px 20px;
        }
        div.line {
            background-color: gray;
            height: 1px;
        }

        div.container-center {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }

        div.container-center div.container-body {
            width: 30%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 10px 20px;
            border-radius: 30px 0 30px 0;
        }
        div.container-center div.container-body img {
            margin-bottom: 10px;
        }
        div.container-center div.container-body div.container-data{
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: white;
            padding: 10px 20px;
            border-radius: 30px 0 30px 0;
        }
    </style>
</head>

<body>
    <div class="container-center">
        <div class="container-body">
            <div class="w-100 flex-center">
                {{-- <img src="/img/favicon/list_100.png" alt="logo_list" /> --}}
                <img src="https://drive.google.com/uc?export=view&id=1N43Zm1fpERiWKcF5IYXfzneGbcxRstwO" alt="Descrição da imagem">
            </div>
            <div class="container-data">
                <h1 class="bolder">Olá! </h1>
                {{-- <h1 class="bolder">Olá! {{ $user->name }}</h1> --}}
                <p>Clique no botão abaixo para validar seu email e voltaremos a fazer nossa lista de tarefa sem
                    interrupções! 😄</p>
                <div class="flex-center">
                    <a href="" class="btn-primary bolder">Verficar E-mail</a>
                    {{-- <a href="{{ $url }}" class="btn-primary bolder">Verficar E-mail</a> --}}
                </div>
                <p>Se você não criou a conta, favor desconsiderar este e-mail</p>
                <p>Saudações, <br> MyList</p>
                <div class="line"></div>
                <div style="margin-top: 10px"></div>
                <p>
                    Se você estiver com problemas para clicar no botão "Verificar E-mail", copie e cole o URL abaixo em
                    seu navegador da web:
                    {{-- Se você estiver com problemas para clicar no botão "Verificar E-mail", copie e cole o URL abaixo em
                    seu navegador da web: <a href="{{ $url }}">{{ $url }}</a> --}}
                </p>
            </div>
        </div>
    </div>
</body>

</html>
