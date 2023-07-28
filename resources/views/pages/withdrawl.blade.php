@extends('master.mastering')

@section('content')

    <div class="container">
        {{-- form --}}
        <form action="{{ route('postWD') }}" method="post">
            @csrf
            <label for="user_id">User Id:</label>
            <input type="text" step="0.01" id="user_id" name="user_id" required>
            <label for="amount">Amount:</label>
            <input type="number" step="0.01" id="amount" name="amount" required>

            <button type="submit">Withdraw</button>
        </form>
        {{-- form --}}
        <h2>Withdrawals Table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($withdrawals as $trn)
                <tr>
                    <td>{{ $trn->id }}</td>
                    <td>{{ $trn->user_id }}</td>
                    <td>{{ $trn->amount }}</td>
                    <td>{{ $trn->date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
     </div>

@endsection



