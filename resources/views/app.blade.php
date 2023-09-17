<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/favicon/list.ico') }}">
    <title>List</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @inertiaHead
    @routes
</head>

<body>
    @inertia
    @if (app()->environment('production'))
        <script>
            console.log("%cEspere!", "color: blue; font-size: 30px; font-weight: bold; background-color: yellow");
            console.log(
                "%cEste é um recurso de navegador voltado para desenvolvedores. Destinado a auxiliar no desenvolvimento, depuração e inspeção de código. Ressaltamos que o console do navegador não deve ser usado para executar códigos não confiáveis ou para fins maliciosos. ",
                "font-size: 18px; font-weight: bold;");
            console.log("%cDesenvolvedor: Tiago Alves",
                "color: green; font-size: 18px; font-weight: bold; background-color: black; text-shadow: white .4px .4px");
            // console.log("TTTTT    III      A     GGG    OOO  ");
            // console.log("  T       I     A   A  G   G  O   O ");
            // console.log("  T       I     A A A  G      O   O ");
            // console.log("  T       I     A   A  G  GG  O   O ");
            // console.log("  T      III    A   A   GGG    OOO  ");
        </script>
    @endif
</body>

</html>
