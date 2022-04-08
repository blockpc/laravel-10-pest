<div>
    <form wire:submit.prevent="save">
        <input type="text" wire:model.defer="user.name">
        <input type="text" wire:model.defer="user.email">
        <select name="role" id="role" wire:model.defer="role"></select>
        <input type="text" wire:model.defer="profile.firstname">
        <input type="text" wire:model.defer="profile.lastname">
        <input type="text" wire:model.defer="profile.phone">
    </form>
</div>
