<?php

namespace App\Filament\Resources;

use App\Models\User;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
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
    protected static ?int $navigationSort = 1;

 

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
                    TextInput::make('email')->email()->required(),
                    TextInput::make('mobile_no')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')->required(),
                    DatePicker::make('join_date')->required()->format('d/m/Y'),
                    TextInput::make('company')->required(),
                    Select::make('department_id')
                    ->relationship('department', 'name')->required(),
                    Select::make('designation_id')
                    ->relationship('designation', 'name')->required(),
                    // Select::make('role_id')
                    // ->multiple()
                    // ->relationship('roles','name')
                    // ->preload(),

                ])
                ]);
    }
   
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Employee Name')->searchable(),
                TextColumn::make('user.name')->label('Username'),
                TextColumn::make('user.email')->label('Email'),
                TextColumn::make('mobile_no')->searchable(),
                TextColumn::make('join_date'),
                TextColumn::make('department.name'),
                TextColumn::make('designation.name'),
                TextColumn::make('created_at'),
              
            ])
            ->filters([
                SelectFilter::make('Department')->relationship('department','name'),
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
