<?php

namespace App\Filament\Resources;

use App\Models\Service;
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
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'RESOURCES';

    protected static ?string $navigationLabel = '事業内容 (Services)';

    protected static ?string $modelLabel = '事業内容 (Service)';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('サービス基本情報 / Service Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title_ja')->label('サービス名 (日本語)')->required(),
                                TextInput::make('title_en')->label('Service Name (English)')->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('subtitle_ja')->label('サブタイトル (日本語)'),
                                TextInput::make('subtitle_en')->label('Subtitle (English)'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('icon')->label('アイコン / 絵文字')->default('💼'),
                                TextInput::make('slug')->label('URL スラッグ')->required(),
                            ]),
                        FileUpload::make('image')
                            ->label('サービス写真 (Image)')
                            ->image()
                            ->directory('services'),
                        Textarea::make('description_ja')->label('説明文 (日本語)')->rows(4)->required(),
                        Textarea::make('description_en')->label('Description (English)')->rows(4)->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('写真')->square(),
                TextColumn::make('title_ja')->label('サービス名')->description(fn (Service $r) => $r->title_en),
                TextColumn::make('icon')->label('Icon'),
                TextColumn::make('slug')->label('Slug')->badge(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
