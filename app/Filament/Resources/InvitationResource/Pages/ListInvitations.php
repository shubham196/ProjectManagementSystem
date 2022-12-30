<?php

namespace App\Filament\Resources\InvitationResource\Pages;

use App\Filament\Resources\InvitationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvitations extends ListRecords
{
    protected static string $resource = InvitationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
