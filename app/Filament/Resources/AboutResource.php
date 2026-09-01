<?php

namespace App\Filament\Resources;

use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationGroup = 'RESOURCES';

    protected static ?string $navigationLabel = '会社紹介・強み (About)';

    protected static ?string $modelLabel = '会社理念・強み (About Info)';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('理念 & ビジョン / Philosophy & Vision')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title_ja')->label('キャッチコピー (日本語)')->required(),
                                TextInput::make('title_en')->label('Catchphrase (English)')->required(),
                            ]),
                        Textarea::make('subtitle_ja')->label('リード文 (日本語)')->rows(3)->required(),
                        Textarea::make('subtitle_en')->label('Lead Text (English)')->rows(3)->required(),
                        FileUpload::make('image')
                            ->label('紹介写真 (About Banner Image)')
                            ->image()
                            ->directory('about'),
                    ]),

                Section::make('MIRANSHの約束 3本柱 / Three Core Promises')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('pillar1_title_ja')->label('第1の約束 タイトル (日本語)'),
                                TextInput::make('pillar2_title_ja')->label('第2の約束 タイトル (日本語)'),
                                TextInput::make('pillar3_title_ja')->label('第3の約束 タイトル (日本語)'),
                            ]),
                        Grid::make(3)
                            ->schema([
                                Textarea::make('pillar1_desc_ja')->label('第1の約束 詳細 (日本語)')->rows(3),
                                Textarea::make('pillar2_desc_ja')->label('第2の約束 詳細 (日本語)')->rows(3),
                                Textarea::make('pillar3_desc_ja')->label('第3の約束 詳細 (日本語)')->rows(3),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title_ja')->label('理念・キャッチコピー'),
                TextColumn::make('subtitle_ja')->label('概要')->limit(50),
            ]);
    }
}
