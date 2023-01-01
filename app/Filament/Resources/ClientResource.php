<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use App\Models\State;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Page;
use Filament\Resources\Pages\Page as PagesPage;
use Filament\Tables\Columns\TextColumn;
use GuzzleHttp\Promise\Create;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    public $country_id;
    public $state_id;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('firstname')
                    ->required()
                    ->maxLength(255),
                TextInput::make('lastname')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('phone')
                ->tel()
                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')->required(),
                TextInput::make('company')->required(),
                Select::make('size')
                    ->options([
                        '1-10' => '1-10',
                        '11-50' => '11-50',
                        '51-200' => '51-200',
                        '200-500' => '200-500',
                        '500-1000' => '500-1000',
                        '1000-5000' => '1000-5000',
                        '5000-10000' => '5000-10000',
                        '10000+' => '10000+',
                    ])->required(),
                Select::make('verticle')->label('Industry Verticle')
                    ->options([
                        'Marketing and advertising' => 'Marketing and advertising',
                        'Management consulting' => 'Management consulting',
                        'Human Resources' => 'Human Resources',
                        'Real Estate' => 'Real Estate',
                        'Computers and information technology' => 'Computers and information technology',
                        'Accounting' => 'Accounting',
                        'Financial services' => 'Financial services',
                        'Health care' => 'Health care',
                        'Automobile Engineering' => 'Automobile Engineering',
                        'Construction' => 'Construction',
                        'Medicine' => 'Medicine',
                        'Media' => 'Media',
                        'Aviation' => 'Aviation',
                        'Food industry' => 'Food industry',
                        'Fashion' => 'Fashion',
                        'Animation' => 'Animation',
                        'Biotechnology' => 'Biotechnology',
                        'Architecture' => 'Architecture',
                        'Arts and crafts' => 'Arts and crafts',
                        'Retail' => 'Retail',
                        'Other' => 'Other',
                    ])->required(),
                Select::make('country_id')
                    ->label('Country')
                    ->options(Country::all()->pluck('name', 'id')->toArray())
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('state_id', null))->required()->preload(),

                Select::make('state_id')
                    ->label('State')
                    ->options(function (callable $get) {
                        $country = Country::find($get('country_id'));
                        if (!$country) {
                            return State::all()->pluck('name', 'id');
                        }
                        return $country->states->pluck('name', 'id');
                    })  ->disabled(function (callable $get) {
                        return !$get('country_id');
                    }),
                    FileUpload::make('avatar')->label('Upload Image')
                    ->image()
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('firstname'),
                TextColumn::make('lastname'),
                TextColumn::make('email'),
                TextColumn::make('verticle'),
                TextColumn::make('size'),
                TextColumn::make('company'),
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/Create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }    
}

