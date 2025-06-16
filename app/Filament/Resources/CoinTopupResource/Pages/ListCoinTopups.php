<?php

namespace App\Filament\Resources\CoinTopupResource\Pages;

use App\Filament\Resources\CoinTopupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoinTopups extends ListRecords
{
    protected static string $resource = CoinTopupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
