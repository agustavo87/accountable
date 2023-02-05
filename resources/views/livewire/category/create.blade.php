<div>
    <form wire:submit.prevent="submit">
        <div>
            <label for="name">Name:</label>
            <input wire:model.defer="name" type="text" name="name">
        </div>
        <button>Create</button>
    </form>
</div>
