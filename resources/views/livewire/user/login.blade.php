<div>
    <div>
        <form wire:submit.prevent="submit">
            <div>
                <label for="email">E-Mail:</label>
                <input wire:model.defer="email" type="email" name="email">
            </div>
            <div>
                <label for="password">Password:</label>
                <input wire:model.defer="password" type="password" name="password">
            </div>
            <button>Login</button>
        </form>
    </div>
</div>