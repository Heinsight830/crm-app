<?php

namespace App\Filament\Pages;

use App\Models\Deal;
use App\Models\Payment;
use App\Models\TrainingSession;
use Filament\Pages\Page;

class CrmDashboard extends Page
{
    protected static ?string $navigationLabel = 'Dashboard';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $title = 'Dashboard';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.dashboard';

    public $totalDeals;
    public $totalRevenue;
    public $renewalsDue;
    public $paidPayments;
    public $pendingPayments;
    public $upcomingTraining;
    public $closedWonDeals;
    public $pipelineValue;
    public $dealsByStage = [];
    public $renewalAlerts = [];
    public $paymentAlerts = [];
    public $trainingAlerts = [];
    public $recentDeals = [];

    public static function getSlug(): string
    {
        return 'crm-dashboard';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin', 'sales', 'trainer']);
    }

    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin', 'sales', 'trainer']);
    }

    public function mount(): void
    {
        $this->totalDeals = Deal::count();
        $this->totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $this->renewalsDue = Deal::where('stage', 'renewal_due')->count();
        $this->paidPayments = Payment::where('status', 'paid')->count();
        $this->pendingPayments = Payment::where('status', 'pending')->count();
        $this->upcomingTraining = TrainingSession::where('status', 'scheduled')->count();
        $this->closedWonDeals = Deal::where('stage', 'closed_won')->count();
        $this->pipelineValue = Deal::whereNotIn('stage', ['closed_lost'])->sum('value');

        $this->dealsByStage = Deal::selectRaw('stage, COUNT(*) as total')
            ->groupBy('stage')
            ->pluck('total', 'stage')
            ->toArray();

        $this->renewalAlerts = Deal::whereNotNull('renewal_date')
            ->whereDate('renewal_date', '<=', now()->addDays(30))
            ->orderBy('renewal_date')
            ->take(5)
            ->get();

        $this->paymentAlerts = Payment::with('deal')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $this->trainingAlerts = TrainingSession::with('deal')
            ->where('status', 'scheduled')
            ->orderBy('session_date')
            ->take(5)
            ->get();

        $this->recentDeals = Deal::with(['organization', 'contact'])
            ->latest()
            ->take(5)
            ->get();
    }
}