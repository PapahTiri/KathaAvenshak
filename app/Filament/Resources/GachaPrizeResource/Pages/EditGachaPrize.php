<?php

namespace App\Filament\Resources\GachaPrizeResource\Pages;

use App\Filament\Resources\GachaPrizeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGachaPrize extends EditRecord
{
    protected static string $resource = GachaPrizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
