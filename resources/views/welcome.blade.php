@extends('master.mastering')

@section('content')
{{-- <!DOCTYPE html>
<html>
<head>
    <title>Transaction Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        h2 {
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
</head>
<body> --}}
    <div class="container">
        <h1 class="my-5 current_balance">Current Balance : {{ $currentBalance }} /-</h1>
        <h2>Transaction Table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Fee</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $trn)
                <tr>
                    <td>{{ $trn->id }}</td>
                    <td>{{ $trn->user_id }}</td>
                    <td>{{ $trn->transaction_type }}</td>
                    <td>{{ $trn->amount }}</td>
                    <td>{{ $trn->fee }}</td>
                    <td>{{ $trn->date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
     </div>

@endsection



