<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use App\Models\Story;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalInquiries = Inquiry::count();
        $pendingInquiries = Inquiry::where('status', '!=', 'resolved')->count();
        $totalStories = Story::count();
        $totalServices = Service::count();

        return [
            Stat::make('Inquiries & Leads', $totalInquiries)
                ->description($pendingInquiries > 0 ? "{$pendingInquiries} 件 未対応" : '全件対応済み')
                ->descriptionIcon($pendingInquiries > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-check-circle')
                ->color($pendingInquiries > 0 ? 'warning' : 'success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 8]),

            Stat::make('Stories & Case Studies', $totalStories)
                ->description('📅 日付ピッカー付き公開管理')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info')
                ->chart([2, 3, 5, 4, 6, 7, 8]),

            Stat::make('Active Services', $totalServices)
                ->description('特定技能 & 登録支援機関')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success'),

            Stat::make('Sakana AI Engine', 'Namazu')
                ->description('● Operational (Fast Multi-turn)')
                ->descriptionIcon('heroicon-m-cpu-chip')
                ->color('primary'),
        ];
    }
}
