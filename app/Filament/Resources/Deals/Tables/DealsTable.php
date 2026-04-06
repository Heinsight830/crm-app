<?php

namespace App\Filament\Resources\Deals\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class DealsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('organization.name')
                    ->label('Organization')
                    ->searchable(),

                Tables\Columns\TextColumn::make('contact.name')
                    ->label('Contact'),

              Tables\Columns\BadgeColumn::make('stage')
    ->colors([
        'primary' => 'new_lead',
        'info' => 'qualified',
        'warning' => 'proposal_sent',
        'gray' => 'contract_sent',
        'danger' => 'payment_pending',
        'success' => 'closed_won',
        'secondary' => 'training_scheduled',
    ])
    ->formatStateUsing(fn ($state) => match ($state) {
        'new_lead' => 'New Lead',
        'qualified' => 'Qualified',
        'proposal_sent' => 'Proposal Sent',
        'contract_sent' => 'Contract Sent',
        'payment_pending' => 'Payment Pending',
        'training_scheduled' => 'Training Scheduled',
        'closed_won' => 'Closed Won',
        'closed_lost' => 'Closed Lost',
        default => $state,
    }),

                Tables\Columns\TextColumn::make('value')
                    ->money('USD'),

                Tables\Columns\TextColumn::make('expected_close_date')
                    ->date(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}