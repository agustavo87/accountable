<div>
    <a href="{{ route('account.create') }}">Create Account</a>
    <div class="table-container">
        <table class="">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Currency</th>
                <th>Balance</th>
                <th>Movements</th>
            </tr>
            @foreach ($accounts as $account)
                <tr>
                    <td>{{ $account->id }}</td>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->currency }}</td>
                    <td>{{ $account->balance }}</td>
                    <td> {{ $account->movements_count }} | <a href="#">View</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
