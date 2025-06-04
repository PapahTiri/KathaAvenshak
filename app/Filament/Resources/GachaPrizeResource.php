<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\GachaPrize;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GachaPrizeResource\Pages;
use App\Filament\Resources\GachaPrizeResource\RelationManagers;

class GachaPrizeResource extends Resource
{
    protected static ?string $model = GachaPrize::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Gacha Prizes';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Hadiah')
                    ->required(),
                TextInput::make('weight')
                    ->label('Bobot (Weight)')
                    ->numeric()
                    ->minValue(1)
                    ->required()
                    ->helperText('Semakin besar bobot, semakin besar kemungkinan terpilih.'),
                Select::make('type')
                    ->label('Tipe Reward')
                    ->options([
                        'coin' => 'Coin',
                        'item' => 'Item',
                        'other' => 'Lainnya',
                    ])
                    ->searchable()
                    ->required(),
                TextInput::make('value')
                    ->label('Nilai Reward')
                    ->helperText('Jika Tipe “coin”, isi jumlah koin; jika “item”, isi nama item.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama Hadiah')->sortable()->searchable(),
                TextColumn::make('weight')->label('Bobot')->sortable(),
                TextColumn::make('type')->label('Tipe'),
                TextColumn::make('value')->label('Nilai'),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListGachaPrizes::route('/'),
            'create' => Pages\CreateGachaPrize::route('/create'),
            'edit' => Pages\EditGachaPrize::route('/{record}/edit'),
        ];
    }
}
