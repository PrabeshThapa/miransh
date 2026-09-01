<?php

namespace App\Filament\Resources;

use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'RESOURCES';

    protected static ?string $navigationLabel = 'よくある質問 (FAQs)';

    protected static ?string $modelLabel = 'FAQ項目 (FAQ)';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('FAQ詳細 / Question & Answer')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('category_ja')->label('カテゴリ (日本語)')->required(),
                                TextInput::make('category_en')->label('Category (English)')->required(),
                            ]),
                        TextInput::make('question_ja')->label('質問 (日本語)')->required(),
                        TextInput::make('question_en')->label('Question (English)')->required(),
                        Textarea::make('answer_ja')->label('回答 (日本語)')->rows(4)->required(),
                        Textarea::make('answer_en')->label('Answer (English)')->rows(4)->required(),
                        TextInput::make('sort_order')->label('並び順 (Sort Order)')->numeric()->default(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category_ja')->label('カテゴリ')->badge(),
                TextColumn::make('question_ja')->label('質問')->limit(40),
                TextColumn::make('sort_order')->label('順序')->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
