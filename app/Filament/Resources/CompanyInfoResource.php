<?php

namespace App\Filament\Resources;

use App\Models\CompanyInfo;
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
use Filament\Tables\Columns\ImageColumn;

class CompanyInfoResource extends Resource
{
    protected static ?string $model = CompanyInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'RESOURCES';

    protected static ?string $navigationLabel = '会社概要・代表者 (Company)';

    protected static ?string $modelLabel = '会社情報 (Company Info)';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('会社基本情報 / Company Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name_ja')->label('会社名 (日本語)')->required(),
                                TextInput::make('name_en')->label('Company Name (English)')->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('legal_status_ja')->label('法人形態 (日本語)')->required(),
                                TextInput::make('legal_status_en')->label('Legal Status (English)')->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('representative_ja')->label('代表者氏名 (日本語)')->required(),
                                TextInput::make('representative_en')->label('Representative (English)')->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('representative_title_ja')->label('役職 (日本語)')->required(),
                                TextInput::make('representative_title_en')->label('Title (English)')->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('capital_ja')->label('資本金 (日本語)')->required(),
                                TextInput::make('capital_en')->label('Capital (English)')->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('established_ja')->label('設立日 (日本語)')->required(),
                                TextInput::make('established_en')->label('Established Date (English)')->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('phone')->label('電話番号 (Phone)')->required(),
                                TextInput::make('email')->label('メールアドレス (Email)')->email()->required(),
                            ]),
                        TextInput::make('business_hours')->label('営業時間 (Business Hours)')->required(),
                        Textarea::make('address_ja')->label('本社所在地 (日本語)')->required(),
                        Textarea::make('address_en')->label('Address (English)')->required(),
                        TextInput::make('access_info_ja')->label('アクセス (日本語)'),
                        TextInput::make('access_info_en')->label('Access (English)'),
                    ]),

                Section::make('代表者写真 & ヒーロー画像 / Images')
                    ->schema([
                        FileUpload::make('ceo_image')
                            ->label('代表取締役 ポートレート写真 (CEO Portrait Image)')
                            ->image()
                            ->directory('company'),
                        FileUpload::make('hero_image')
                            ->label('トップページ ヒーローバナー画像 (Hero Background Image)')
                            ->image()
                            ->directory('company'),
                        Textarea::make('ceo_message_ja')->label('代表メッセージ (日本語)')->rows(4),
                        Textarea::make('ceo_message_en')->label('CEO Message (English)')->rows(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('ceo_image')->label('CEO 写真')->circular(),
                TextColumn::make('name_ja')->label('会社名')->description(fn (CompanyInfo $r) => $r->representative_ja),
                TextColumn::make('phone')->label('電話番号'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('address_ja')->label('所在地')->limit(30),
            ]);
    }
}
