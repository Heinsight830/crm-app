<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('deal.title')
                    ->label('Deal'),

                Tables\Columns\TextColumn::make('reference'),

                Tables\Columns\TextColumn::make('amount')
                    ->money('USD'),

                Tables\Columns\BadgeColumn::make('status'),

                Tables\Columns\TextColumn::make('paid_at')
                    ->date(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}