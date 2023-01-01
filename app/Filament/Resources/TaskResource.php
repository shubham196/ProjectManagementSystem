<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Project;
use App\Models\Client;
use App\Models\Task;
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
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;
    protected static ?string $navigationGroup = 'Project Management';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 2 ;
    public static function form(Form $form): Form
{      if (Auth::check()) {
        $user_id = Auth::id();
        $options = User::where('current_tenant_id', $user_id)->get()->pluck('name', 'id');
   
    } else {
        // Redirect to login page or show an error message
    }
        return $form
            ->schema([
                Select::make('project_id')
                ->relationship('project', 'name')
                ->required(),
             TextInput::make('name')->label('Task Name')->required(),
                    DatePicker::make('start_date')->format('d/m/Y')->required(),
                    DatePicker::make('end_date')->format('d/m/Y'),
                Select::make('priority')
                    ->options([
                        'High' => 'High',
                        'Medium' => 'Medium',
                        'Low' => 'Low',

                    ])->required(),
                    Select::make('user_id')->label('Assign By')
                    ->relationship('user', 'name')
                    ->options($options)
                    ->required(),
                  
                  Select::make('team_id')->label('Team')
                  ->options($options)
                    ->multiple()
                    ->required()
                    ->preload(),

                RichEditor::make('task_description'),
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
        if (Auth::check()) {
            $user_id = Auth::id();
            $options = User::where('current_tenant_id', $user_id)->get()->pluck('name', 'id');
       
        } else {
            // Redirect to login page or show an error message
        }
        return $table
            ->columns([
                TextColumn::make('name')->label('Task Name')->searchable(),
                TextColumn::make('project.name')->label('Project Name')->searchable(),
                TextColumn::make('user.name')->label('Assignee')->searchable(),
                TextColumn::make('start_date')->label('Start Date')->searchable(),
                TextColumn::make('end_date')->label('Due Date')->searchable(),
                TextColumn::make('priority')->searchable(),
                TextColumn::make('status')->searchable(),
                TextColumn::make('team_id')->searchable(),
            ])
            ->filters([
                SelectFilter::make('priority')
                ->options([
                    'High' => 'High',
                    'Medium' => 'Medium',
                    'Low' => 'Low',
                ]),
                SelectFilter::make('status')
                ->options([
                    'Active' => 'Active',
                    'Hold' => 'Hold',
                    'Notice Period' => 'Notice Period',
                ]),
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }    
}
