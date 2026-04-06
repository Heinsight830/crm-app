<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('deal_id')
                ->relationship('deal', 'title')
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('reference'),

            Forms\Components\TextInput::make('amount')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'paid' => 'Paid',
                ])
                ->default('pending')
                ->required(),

            Forms\Components\DatePicker::make('paid_at'),
        ]);
    }
}