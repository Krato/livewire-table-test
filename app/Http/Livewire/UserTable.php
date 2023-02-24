<?php

namespace App\Http\Livewire;

use App\Models\User;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class UserTable extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return User::query();
    }

    public function isTableSearchable(): bool
    {
        return true;
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('email')->searchable()->sortable(),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('Logger')
                ->action(function (Collection $records) {
                    foreach ($records as $record) {
                        logger()->info($record->name);
                    }
                })
                ->deselectRecordsAfterCompletion()
        ];
    }



    public function render(): View
    {
        return view('livewire.user-table');
    }
}
