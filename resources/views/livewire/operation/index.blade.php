<div>
    <h2>Operations & Movements</h2>
    <div>
        <label for="accounts">Account:</label>
        <select wire:model="account" name="accounts">
            <option value="" selected>All</option>
            @foreach ($accounts as $account_)
                <option value="{{$account_['id']}}">{{$account_['name']}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="categories">Category:</label>
        <select wire:model="category" name="category">
            <option value="" selected>All</option>
            @foreach ($categories as $category_)
                <option value="{{$category_['id']}}">{{$category_['name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="table-container">
        @if(count($operations))
            <table>
                <tr>
                    <th>Operation ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Account</th>
                    <th>Note</th>
                    <th>Debit</th>
                    <th>Credit</th>
                </tr>
                @php
                    $odd = false;
                @endphp
                @foreach ($operations as $operation)
                    @php
                        $odd = !$odd;
                    @endphp
                    @foreach ($operation->movements as $movement)
                        <tr class="{{ $odd ? 'darker' : ''}}">
                            <td>{{ $operation->id }}</td>
                            <td>{{ $operation->category->name }}</td>
                            <td>{{ $operation->name }}</td>
                            <td>{{ $movement->account->name }}</td>
                            <td>{{ $movement->note }}</td>
                            <td>{{ $movement->type == 1 ? '' : $movement->amount }}</td>
                            <td>{{ $movement->type == 1 ? $movement->amount : '' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        @else
            <div>No operation found.</div>
        @endif
    </div>
</div>
