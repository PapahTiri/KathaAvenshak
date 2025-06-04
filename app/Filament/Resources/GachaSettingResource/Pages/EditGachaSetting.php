<?php

namespace App\Filament\Resources\GachaSettingResource\Pages;

use App\Filament\Resources\GachaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGachaSetting extends EditRecord
{
    protected static string $resource = GachaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
