<?php

namespace App\Filament\Resources\CoinTopupResource\Pages;

use App\Filament\Resources\CoinTopupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoinTopup extends EditRecord
{
    protected static string $resource = CoinTopupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
