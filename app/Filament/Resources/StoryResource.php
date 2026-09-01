<?php

namespace App\Filament\Resources;

use App\Models\Story;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;

class StoryResource extends Resource
{
    protected static ?string $model = Story::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'RESOURCES';

    protected static ?string $navigationLabel = '採用事例・お知らせ (Stories)';

    protected static ?string $modelLabel = '採用事例 (Story)';

    protected static ?string $pluralModelLabel = '採用事例・お知らせ (Stories)';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('基本情報 / Basic Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title_ja')
                                    ->label('タイトル (日本語)')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('神奈川県・介護老人保健施設での特定技能マッチング'),
                                TextInput::make('title_en')
                                    ->label('Title (English)')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Caregiving Placement in Kanagawa'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('category_ja')
                                    ->label('カテゴリ (日本語)')
                                    ->required()
                                    ->default('特定技能 / 介護分野'),
                                TextInput::make('category_en')
                                    ->label('Category (English)')
                                    ->required()
                                    ->default('Nursing Care / SSW'),
                            ]),
                        DatePicker::make('published_date')
                            ->label('📅 公開日 (Published Date)')
                            ->default(now())
                            ->displayFormat('Y.m.d')
                            ->native(false)
                            ->required(),
                        FileUpload::make('image')
                            ->label('カバー写真 (Cover Image)')
                            ->image()
                            ->directory('stories')
                            ->default('/images/story1.jpg'),
                    ]),

                Section::make('概要 & 本文 / Content & Details')
                    ->schema([
                        Textarea::make('summary_ja')
                            ->label('概要文 (日本語)')
                            ->rows(3)
                            ->required(),
                        Textarea::make('summary_en')
                            ->label('Summary (English)')
                            ->rows(3)
                            ->required(),
                        Textarea::make('content_ja')
                            ->label('本文・詳細 (日本語)')
                            ->rows(6)
                            ->placeholder('採用に至った経緯、受け入れ企業の課題、マッチング後の成果など'),
                        Textarea::make('content_en')
                            ->label('Content / Details (English)')
                            ->rows(6)
                            ->placeholder('Case details, onboarding, and achievements in English'),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('author')
                                    ->label('執筆者 (Author)')
                                    ->default('MIRANSH 編集部'),
                                Toggle::make('featured')
                                    ->label('★ おすすめ記事として表示 (Featured)')
                                    ->default(false),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('写真')
                    ->circular(false)
                    ->square(),
                TextColumn::make('title_ja')
                    ->label('タイトル')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Story $record): string => $record->title_en ?? ''),
                TextColumn::make('category_ja')
                    ->label('カテゴリ')
                    ->badge()
                    ->color('warning'),
                TextColumn::make('published_date')
                    ->label('公開日')
                    ->date('Y.m.d')
                    ->sortable(),
                IconColumn::make('featured')
                    ->label('注目')
                    ->boolean(),
            ])
            ->filters([
                Filter::make('featured')
                    ->query(fn ($query) => $query->where('featured', true)),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
