<div>
    <div>
        <form wire:submit.prevent="create">
            <div>
                <label for="name">Name:</label>
                <input wire:model.defer="account.name" type="text" name="name">
            </div>
            <div>
                <label for="currency">Currency:</label>
                <input wire:model.defer="account.currency" type="text" name="currency" minlength="3">
            </div>
            <div>
                <label for="balance">Balance:</label>
                <input wire:model.defer="account.balance" type="number" name="balance" value="0">
            </div>
            <button>Register</button>
        </form>
    </div>
    
</div>
