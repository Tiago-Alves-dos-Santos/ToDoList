<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/img/favicon/list.ico">
    <title>Tarefas PDF</title>
    <style>
        .w-100 {
            width: 100%;
        }
        div.header{
            border: 1px solid black;
        }
        .bold{
            font-weight: bold;
        }
        .table{
            width: 100%;
            text-align: center;
        }
        .table tr td{
            border: .4px solid gray;
        }
        .bg-green{
            background-color: green;
        }
        .bg-red{
            background-color: rgb(123, 11, 11);
        }
        .bg-green, .bg-red{
            color: white;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="w-100">
        <div class="header">
            <h3>
                <span class="bold">Nome:</span> {{ $user->name }}
            </h3>
            <h4>
                <span class="bold">Impressão(Data):</span> {{ date('d/m/y H:i') }}
            </h4>
            <h6>
                <span class="bold">OBS:</span> PDF gerado pelo sistema {{ config('app.name') }}
            </h6>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <td>Tarefa</td>
                    <td>Status</td>
                    <td>Data</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $value)
                    <tr>
                        <td style="text-transform: capitalize">{{ $value->task }}</td>
                        <td style="text-transform: uppercase" @class([
                            'bg-red' => !empty($value->deleted_at),
                            'bg-green' => (empty($value->deleted_at) && $value->isCompleted()),
                        ])>{{ $value->getStatusYourLanguage() }}</td>
                        <td>{{ date('d/m/Y', strtotime($value->created_at)) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center">N/A</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:end">
                        Total de tarefas: {{ $all_count_tasks }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
