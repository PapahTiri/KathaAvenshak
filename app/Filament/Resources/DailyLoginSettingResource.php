<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\DailyLoginSetting;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DailyLoginSettingResource\Pages;
use App\Filament\Resources\DailyLoginSettingResource\RelationManagers;

class DailyLoginSettingResource extends Resource
{
    protected static ?string $model = DailyLoginSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Login Rewards';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('reward_amount')
                ->label('Reward per Login (coins)')
                ->numeric()
                ->minValue(0)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reward_amount')->label('Amount'),
                TextColumn::make('updated_at')->label('Updated')->dateTime(),
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
            'index' => Pages\ListDailyLoginSettings::route('/'),
            'create' => Pages\CreateDailyLoginSetting::route('/create'),
            'edit' => Pages\EditDailyLoginSetting::route('/{record}/edit'),
        ];
    }
}
