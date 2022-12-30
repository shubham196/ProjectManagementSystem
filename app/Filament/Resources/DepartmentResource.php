<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;

use App\Models\Department;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationGroup = 'Users';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 4;
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                ])
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }    
}
