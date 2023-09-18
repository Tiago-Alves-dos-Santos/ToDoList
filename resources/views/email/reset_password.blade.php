<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/favicon/list.ico') }}">
    <title>Confirmar email</title>
    <style>
        body {
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

        .btn-primary{
            text-decoration: none;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
        }
        div.line {
            background-color: gray;
            height: 1px;
        }
        div.button-center{
            text-align: center;
        }
        div.button-center button{
            display: inline-block;
        }

        div.container-center {
            position: relative;
            width: 100%;
            margin: 0 auto;

        }
        div.container-center div.container-body {
            width: 70%;
            margin: 0 auto;
            padding: 20px 0;
            border-radius: 30px 0 30px 0;
        }
        div.container-center div.container-body .img-center {
            width: 100%;
            text-align: center;
        }
        div.container-center div.container-body .img-center img {
            display: inline-block;
            max-width: 100px;
        }
        div.container-center div.container-body div.container-data{
            width: 100%;
            padding: 10px 20px;
            border-radius: 30px 0 30px 0;
        }
    </style>
</head>

<body style="background-color: #66396E;">
    <div class="container-center">
        <div class="container-body">
            <div class="img-center">
                {{-- <img src="/img/favicon/list_100.png" alt="logo_list" /> --}}
                <img src="https://drive.google.com/uc?export=view&id=1N43Zm1fpERiWKcF5IYXfzneGbcxRstwO" alt="Descrição da imagem">
            </div>
            <div class="container-data" style="background-color: white">
                <h1 class="bolder">Olá! {{ $user->name }}</h1>
                <p>
                    Clique no botão abaixo para nos fornecer sua nova senha 😄 <br>
                    Esse email tem validade de {{ $time_expire }} minutos
                </p>
                <div class="button-center">
                    <a href="{{ $url }}" class="btn-primary bolder" style="background-color: #66396E; color: white;">RESETAR SENHA</a>
                </div>
                <p>Saudações, <br> MyList</p>
                <div class="line"></div>
                <div style="margin-top: 10px"></div>
                <p>
                    Se você estiver com problemas para clicar no botão "Resetar senha", copie e cole o URL abaixo em
                    seu navegador da web: <a href="{{ $url }}">{{ $url }}</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
