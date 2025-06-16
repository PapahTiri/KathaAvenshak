<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\CoinTopup;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CoinTopupResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CoinTopupResource\RelationManagers;

class CoinTopupResource extends Resource
{
    protected static ?string $model = CoinTopup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('user.name')->label('User')->searchable(),
            TextColumn::make('coinPackage.name')->label('Paket Koin'),
            TextColumn::make('coinPackage.amount')->label('Jumlah Koin'),
            TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                'pending' => 'warning',
                'success' => 'success',
                'failed' => 'danger',
                default => 'gray',
            }),
            TextColumn::make('created_at')->label('Tanggal')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Pending',
                    'success' => 'Success',
                    'failed' => 'Failed',
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoinTopups::route('/'),
            'create' => Pages\CreateCoinTopup::route('/create'),
            'edit' => Pages\EditCoinTopup::route('/{record}/edit'),
        ];
    }
}
