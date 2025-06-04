<?php

namespace App\Filament\Resources\NovelResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ChapterRelationManager extends RelationManager
{
    protected static string $relationship = 'chapters';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('chapter_number')
                ->label('Chapter Number')
                ->numeric()
                ->required(),

            TextInput::make('title')
                ->required()
                ->label('Chapter Title'),

            RichEditor::make('content')
                ->required()
                ->label('Content')
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('chapter_number')->sortable()->label('No. Chapter'),
            TextColumn::make('title')->searchable()->label('Judul'),
            TextColumn::make('created_at')->dateTime()->label('Dibuat'),
        ]);
    }
}
