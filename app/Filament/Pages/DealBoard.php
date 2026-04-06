<?php

namespace App\Filament\Pages;

use App\Models\Deal;
use Filament\Pages\Page;

class DealBoard extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-view-columns';

    protected static ?string $navigationLabel = 'Deal Board';

    protected static ?string $title = 'Deal Board';

    protected string $view = 'filament.pages.deal-board';

    public array $columns = [];

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin', 'sales']);
    }

    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin', 'sales']);
    }

    public function mount(): void
    {
        $this->columns = [
            [
                'key' => 'new_lead',
                'label' => 'New Lead',
                'deals' => Deal::with(['organization', 'contact'])->where('stage', 'new_lead')->get(),
            ],
            [
                'key' => 'qualified',
                'label' => 'Qualified',
                'deals' => Deal::with(['organization', 'contact'])->where('stage', 'qualified')->get(),
            ],
            [
                'key' => 'proposal_sent',
                'label' => 'Proposal Sent',
                'deals' => Deal::with(['organization', 'contact'])->where('stage', 'proposal_sent')->get(),
            ],
            [
                'key' => 'contract_sent',
                'label' => 'Contract Sent',
                'deals' => Deal::with(['organization', 'contact'])->where('stage', 'contract_sent')->get(),
            ],
            [
                'key' => 'payment_pending',
                'label' => 'Payment Pending',
                'deals' => Deal::with(['organization', 'contact'])->where('stage', 'payment_pending')->get(),
            ],
            [
                'key' => 'training_scheduled',
                'label' => 'Training Scheduled',
                'deals' => Deal::with(['organization', 'contact'])->where('stage', 'training_scheduled')->get(),
            ],
            [
                'key' => 'active',
                'label' => 'Active',
                'deals' => Deal::with(['organization', 'contact'])->where('stage', 'active')->get(),
            ],
            [
                'key' => 'renewal_due',
                'label' => 'Renewal Due',
                'deals' => Deal::with(['organization', 'contact'])->where('stage', 'renewal_due')->get(),
            ],
            [
                'key' => 'closed_won',
                'label' => 'Closed Won',
                'deals' => Deal::with(['organization', 'contact'])->where('stage', 'closed_won')->get(),
            ],
            [
                'key' => 'closed_lost',
                'label' => 'Closed Lost',
                'deals' => Deal::with(['organization', 'contact'])->where('stage', 'closed_lost')->get(),
            ],
        ];
    }
}