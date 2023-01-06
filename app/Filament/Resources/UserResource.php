<?php

namespace App\Filament\Resources;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Resources\ProjectResource\RelationManagers;
use Dflydev\DotAccessData\Data;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\DB;
use Filament\MutableDataTable;
use Symfony\Component\Console\Helper\TableRows;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{

    
    
        // The authenticated user is authorized to view the user's details.
        // You can return the view or perform other actions here.
    
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 2 ;
    public static function form(Form $form): Form
    {
      
        return $form
            ->schema([
                
                TextInput::make('name'),
                TextInput::make('email'),
                Select::make('roles')
                ->multiple()
                ->relationship('roles','name')
                ->preload(),
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('current_tenant_id', Auth::id());
    }
    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('created_at'),
            ])
            
            ->filters([
                 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}/view'),
        ];
    }   
}
 
