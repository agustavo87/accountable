<div>
    <h2>Operation</h2>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form wire:submit.prevent="submit">
        <div>
            <label for="categories">Category:</label>
            <select wire:model="category" name="categories">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <a href="{{ route('category.create') }}">Create</a>
        </div>
        <div>
            <label for="name">Name:</label>
            <input wire:model.defer="operation.name" type="text" name="name">
        </div>
        <div>
            <label for="name">Notes:</label>
            <textarea wire:model.defer="operation.notes" name="name"></textarea>
        </div>
        <h3>Movement</h3>
        <div>
            <label for="accounts">Account:</label>
            <select wire:model.defer="movement.account_id" name="accounts">
                @foreach ($accounts as $account)
                    <option value="{{$account->id}}">{{$account->name}}</option>
                @endforeach
            </select>
            <a href="{{ route('account.create') }}">Create</a>
        </div>
        <div>
            <label for="movement-type">Type:</label>
            <select wire:model.defer="movement.type" name="movement-type">
                <option value="0">Debit</option>
                <option value="1">Credit</option>
            </select>
        </div>
        <div>
            <label for="movement-note">Note:</label>
            <input wire:model.defer="movement.note" type="text" name="movement-note">
        </div>
        <div>
            <label for="movement-amount">Amount:</label>
            <input wire:model.defer="movement.amount" type="number" name="movement-amount">
        </div>
        <button wire:click="commitMovement" type="button">Commit</button>
        <hr>
            <h4>Operation Movements</h4>
            <ul>
                @foreach ($movements as $move)
                    <li>{{$move['account']['name']}} : {{($move['type'] == 1 ? '$' : '-$'). $move['amount']}}  </li>
                @endforeach
            </ul>
        <hr>
        <button type="submit">Submit</button>
    </form>
</div>
