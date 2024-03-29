<?php

namespace App\Filament\Widgets;
use Closure;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
class ProjectsLeader extends BaseWidget
{
    protected static string $view = 'filament.widgets.projects-leader';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Project::with('name')->latest()->take(5);
    }

    protected function getTableColumns(): array
    {
        return [
           TextColumn::make('created_at')->label('Time'),
            TextColumn::make('users.name'),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

