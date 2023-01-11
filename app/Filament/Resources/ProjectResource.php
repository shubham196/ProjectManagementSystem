<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\Pages\ProjectView;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use Filament\Tables\Actions\AttachAction;
use App\Http\Controllers\ProjectController;
use Carbon\Traits\Options;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\LinkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Widgets\BlogPostsChart;
class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationGroup = 'Project Management';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 1 ;
 
    public static function form(Form $form): Form
    {
        $users = User::all();
        $options = [];
        foreach ($users as $user) {
            $options[$user->id] = $user->name;
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
                    ->options($options)
                    ->label('Leader')
                    ->searchable()
                ,
                RichEditor::make('description'),
                FileUpload::make('attachments'),
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
                TextColumn::make('name')->searchable(),
                TextColumn::make('client.firstname')->searchable(),
                TextColumn::make('users.name')->searchable(),
                TextColumn::make('start_date')->searchable(),
                TextColumn::make('end_date')->searchable(),
                TextColumn::make('priority')->searchable(),
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
                Tables\Actions\ViewAction::make(),
              
            ])
            ->prependActions([
                
                LinkAction::make('view')->url(fn($record) => static::generateUrl('show', ['record' => $record])),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),

            ]);

    }
    public static function getWidgets(): array
    {
        return [
          BlogPostsChart::class,
        ];
    }
    public static function getRelations(): array
    {
        return [
            RelationManagers\ProjectUserRelationManager::class,
        ];
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
   


  
   

