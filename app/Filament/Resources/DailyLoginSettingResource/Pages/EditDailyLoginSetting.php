<?php

namespace App\Filament\Resources\DailyLoginSettingResource\Pages;

use App\Filament\Resources\DailyLoginSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyLoginSetting extends EditRecord
{
    protected static string $resource = DailyLoginSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
