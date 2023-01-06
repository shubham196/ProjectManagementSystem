<?php

namespace App\Filament\Resources\TaskResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;
use App\Models\Task;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class TaskUserRelationManager extends RelationManager
{
    protected static string $relationship = 'users';
    protected static ?string $title = 'Team';
    protected static ?string $recordTitleAttribute = 'name';


    public static function form(Form $form): Form
    {

        $users= User::all();
        
        $options = [];
        foreach ($users as $user) {
            $options[$user->id] = $user->name;
        }

        return $form
            ->schema([
                    Select::make('user_id')
                    ->options($options)
                    ->required(),
            ]);
           
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()->preloadRecordSelect(),
              

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make()->label('Remove'),
              
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
