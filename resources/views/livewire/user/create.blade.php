<div>
    <form wire:submit.prevent="submit">
        <div>
            <label for="name">Name:</label>
            <input wire:model.defer="user.name" type="text" name="name">
        </div>
        <div>
            <label for="email">E-Mail:</label>
            <input wire:model.defer="user.email" type="email" name="email">
        </div>
        <div>
            <label for="password">Password:</label>
            <input wire:model.defer="password" type="password" name="password">
        </div>
        <button>Register</button>
    </form>
</div>
