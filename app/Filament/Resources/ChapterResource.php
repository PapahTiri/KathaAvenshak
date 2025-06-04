<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Chapter;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ChapterResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ChapterResource\RelationManagers;

class ChapterResource extends Resource
{
    protected static ?string $model = Chapter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('novel_id')
                    ->label('novel')
                    ->relationship('novel', 'title')
                    ->required(),
                textInput::make('chapter_number')
                    ->label('chapter #')
                    ->numeric()
                    ->required(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('unlock_price')
                    ->label('coins')
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                TextInput::make('lock_days')
                    ->label('Lock Durasi (hari)')
                    ->numeric()
                    ->minValue(0)
                    ->default(7),
                Toggle::make('unlocked_manually')
                    ->label('Unlock Manual')
                    ->helperText('Centang untuk langsung membuka tanpa menunggu lock_days'),

        RichEditor::make('content')
            ->label('Konten Bab')
            ->required()
            ->toolbarButtons([
                'bold',
                'italic',
                'underline',
                'strike',
                'h2',
                'h3',
                'bulletList',
                'orderedList',
                'link',
                'blockquote',
                'codeBlock',
                'undo',
                'redo',
            ])
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('novel.title')->label('Novel')->sortable()->searchable(),
                TextColumn::make('chapter_number')->sortable(),
                TextColumn::make('title')->searchable(),
                TextColumn::make('unlock_price')->label('Harga (coin)'),
                TextColumn::make('lock_days')->label('Kunci (hari)'),
                \Filament\Tables\Columns\BooleanColumn::make('unlocked_manually')->label('Manual Unlock'),
                TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListChapters::route('/'),
            'create' => Pages\CreateChapter::route('/create'),
            'edit' => Pages\EditChapter::route('/{record}/edit'),
        ];
    }
}
