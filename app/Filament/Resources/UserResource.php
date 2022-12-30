<?php

namespace App\Filament\Resources;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use setRows;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class UserResource extends Resource
{
   
    
        // The authenticated user is authorized to view the user's details.
        // You can return the view or perform other actions here.
    
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Users';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
  public static function authcheck(){
    if (Auth::check()) {
        $user_id = Auth::id();
        $users = User::where('current_tenant_id', $user_id)->get();
    } else {
        // Redirect to login page or show an error message
    }
}
    public static function table(Table $table): Table
    {

      
        
        return $table
        
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('created_at')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }   
}
 
