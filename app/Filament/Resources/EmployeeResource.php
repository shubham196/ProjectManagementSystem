<?php

namespace App\Filament\Resources;

use App\Models\User;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $navigationGroup = 'Users';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 2;

 

    public static function form(Form $form): Form
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $options = User::where('current_tenant_id', $user_id)->get()->pluck('name', 'id');
       
        } else {
            // Redirect to login page or show an error message
        }
        return $form
        ->schema([
            Card::make()
                ->schema([
                    Select::make('user_id')
                    ->options($options)->unique()
                    ->required(),
                    TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    TextInput::make('user.email')->required(),
                    TextInput::make('mobile_no')->required()->maxLength('10'),
                    TextInput::make('join_date')->required(),
                    TextInput::make('company')->required(),
                    Select::make('department_id')
                    ->relationship('department', 'name')->required(),
                    Select::make('designation_id')
                    ->relationship('designation', 'name')->required(),
          

                ])
                ]);
    }
   
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('user.name')->label('Username'),
                TextColumn::make('user.email')->label('Email'),
                TextColumn::make('mobile_no'),
                TextColumn::make('join_date'),
                TextColumn::make('department.name'),
                TextColumn::make('designation.name'),
                TextColumn::make('created_at'),
              
            ])
            ->filters([
                //
            ])
            ->actions([
                
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }    
}
