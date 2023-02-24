<?php

use App\Http\Livewire\UserTable;
use App\Models\User;
use Filament\Tables\Actions\BulkAction;

it('I can test the table bulk action', function () {

    $user = User::factory()->create();
    $users = User::factory()->count(5)->create();

    $this->actingAs($user)
        ->livewire(UserTable::class)
        ->callTableBulkAction(BulkAction::class, $users)
        ->assertHasNoTableBulkActionErrors();
});
