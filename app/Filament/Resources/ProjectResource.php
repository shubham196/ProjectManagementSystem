<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use Filament\Forms\Components\RichEditor;
use Filament\Forms;
use Filament\Forms\Components\Concerns\CanBePreloaded;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PHPUnit\Framework\Test;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                TextInput::make('name')->label('Project Name'),
                Select::make('client_id')
                    ->relationship('client', 'firstname'),
                    DatePicker::make('start_date')->format('d/m/Y'),
                    DatePicker::make('end_date')->format('d/m/Y'),
                Select::make('priority')
                    ->options([
                        'High' => 'High',
                        'Medium' => 'Medium',
                        'Low' => 'Low',

                    ])->required(),
                    Select::make('user_id')
                    ->relationship('user', 'name')
                    ->options($options)
                    ->required(),
                  
                  Select::make('team')
                  ->options($options)
                    ->multiple()
                    ->required()
                    ->preload(),

                RichEditor::make('description'),
                FileUpload::make('attachments')->multiple(),
                Select::make('status')
                ->options([
                    'Active' => 'Active',
                    'Hold' => 'Hold',
                    'Notice Period' => 'Notice Period',
                ])->required(),
               
            ]);
    }

    public static function table(Table $table): Table
    {
        
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('client.firstname'),
                TextColumn::make('user.name'),
                // TextColumn::make('team'),
                TextColumn::make('start_date'),
                TextColumn::make('end_date'),
                TextColumn::make('priority'),

                
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }    
}
