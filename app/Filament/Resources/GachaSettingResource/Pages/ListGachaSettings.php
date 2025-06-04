<?php

namespace App\Filament\Resources\GachaSettingResource\Pages;

use App\Filament\Resources\GachaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGachaSettings extends ListRecords
{
    protected static string $resource = GachaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
