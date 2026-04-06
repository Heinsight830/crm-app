<?php

namespace App\Filament\Resources\TrainingSessions\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class TrainingSessionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('deal.title')
                    ->label('Deal'),

                Tables\Columns\TextColumn::make('title'),

                Tables\Columns\TextColumn::make('session_date')
                    ->date(),

                Tables\Columns\TextColumn::make('trainer_name')
                    ->label('Trainer'),

                Tables\Columns\BadgeColumn::make('status'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}