<?php

namespace App\Filament\Resources;

use App\Models\Inquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'COMMUNICATION';

    protected static ?string $navigationLabel = 'お問い合わせ (Inquiries)';

    protected static ?string $modelLabel = 'お問い合わせ (Inquiry)';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('お客様情報 & 問い合わせ内容 / Inquiry Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')->label('お名前 / 企業名')->required(),
                                TextInput::make('email')->label('メールアドレス')->email()->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('phone')->label('電話番号'),
                                TextInput::make('category')->label('種別 / 分野')->required(),
                            ]),
                        Textarea::make('message')->label('メッセージ・ご相談内容')->rows(5)->required(),
                        Select::make('status')
                            ->label('ステータス (Status)')
                            ->options([
                                'new' => '🟡 新着 (New)',
                                'in_progress' => '🔵 対応中 (In Progress)',
                                'resolved' => '🟢 完了 (Resolved)',
                            ])
                            ->default('new')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('受信日時')->dateTime('Y-m-d H:i')->sortable(),
                TextColumn::make('name')->label('送信者 / 企業名')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('category')->label('種別')->badge(),
                TextColumn::make('status')
                    ->label('ステータス')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'in_progress' => 'info',
                        'resolved' => 'success',
                        default => 'gray',
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
