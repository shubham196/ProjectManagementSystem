<?php

namespace App\Filament\Resources\ProjectResource\Pages;
use App\Http\Controllers\ProjectController;
use App\Filament\Resources\ProjectResource;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\Project;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Pages\ViewRecord;
use Livewire\Component;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;


class ProjectView extends ViewRecord {
        // Generate an absolute URL for the ProjectView resource route with no parameters
   
    protected static string $resource = ProjectResource::class;

    protected static string $view = 'filament.resources.project-resource.pages.project-view';

    // protected static ?string $breadcrumb = 'project view';

    protected static ?string $title = 'Project Details';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function user()
    {

        $users = User::all();
    }
   
    
  
    
}

// Generate a relative URL for the ProjectView resource route with the 'id' parameter set to 123




    
