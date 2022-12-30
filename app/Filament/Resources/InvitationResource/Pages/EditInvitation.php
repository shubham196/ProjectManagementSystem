<?php

namespace App\Filament\Resources\InvitationResource\Pages;

use App\Filament\Resources\InvitationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvitation extends EditRecord
{
    protected static string $resource = InvitationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
