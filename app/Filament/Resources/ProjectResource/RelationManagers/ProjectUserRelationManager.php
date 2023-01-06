<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Resources\ProjectResource\Pages;
use Filament\Forms;
use App\Models\Project;
use App\Models\User;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\RecordActions\Link;


class ProjectUserRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $title = "Team";
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        
        $users= User::all();
        $options = [];
        foreach ($users as $user) {
            $options[$user->id] = $user->name;
        }
        $var1 = json_encode($options);
        return $form
            ->schema([
               
                    Select::make('user_id')
                    ->relationship('users','name')
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
                
                Tables\Actions\AttachAction::make(),
                AttachAction::make()->preloadRecordSelect(),
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
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            'view' => Pages\ProjectView::route('/{record}/view'),
        ];
    }
}
