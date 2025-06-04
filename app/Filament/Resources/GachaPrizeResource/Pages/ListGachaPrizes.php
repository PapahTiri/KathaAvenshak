<?php

namespace App\Filament\Resources\GachaPrizeResource\Pages;

use App\Filament\Resources\GachaPrizeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGachaPrizes extends ListRecords
{
    protected static string $resource = GachaPrizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
