<?php

namespace App\Filament\Resources\Deals\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class DealForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('organization_id')
                ->relationship('organization', 'name')
                ->required()
                ->searchable(),

            Forms\Components\Select::make('contact_id')
                ->relationship('contact', 'name')
                ->searchable(),

            Forms\Components\TextInput::make('title')
                ->required(),

            Forms\Components\Select::make('stage')
                ->options([
                    'new_lead' => 'New Lead',
                    'qualified' => 'Qualified',
                    'proposal_sent' => 'Proposal Sent',
                    'contract_sent' => 'Contract Sent',
                    'payment_pending' => 'Payment Pending',
                    'training_scheduled' => 'Training Scheduled',
                    'active' => 'Active',
                    'renewal_due' => 'Renewal Due',
                    'closed_won' => 'Closed Won',
                    'closed_lost' => 'Closed Lost',
                ])
                ->default('new_lead')
                ->required(),

            Forms\Components\DatePicker::make('renewal_date')
                ->label('Renewal Date'),

            Forms\Components\TextInput::make('value')
                ->numeric()
                ->prefix('$'),

            Forms\Components\DatePicker::make('expected_close_date'),

            Forms\Components\Textarea::make('notes'),
        ]);
    }
}