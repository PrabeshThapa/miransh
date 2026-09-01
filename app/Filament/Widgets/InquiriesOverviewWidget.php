<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class InquiriesOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = '最新のお問い合わせ (Recent Inquiries)';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Inquiry::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('created_at')->label('受信日時')->dateTime('Y-m-d H:i'),
                TextColumn::make('name')->label('送信者 / 企業名'),
                TextColumn::make('email')->label('Email'),
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
            ]);
    }
}
