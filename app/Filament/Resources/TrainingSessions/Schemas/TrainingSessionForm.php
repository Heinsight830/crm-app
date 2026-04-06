<?php

namespace App\Filament\Resources\TrainingSessions\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class TrainingSessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('deal_id')
                ->relationship('deal', 'title')
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('title')
                ->required(),

            Forms\Components\DatePicker::make('session_date')
                ->required(),

            Forms\Components\TextInput::make('trainer_name'),

            Forms\Components\Select::make('status')
                ->options([
                    'scheduled' => 'Scheduled',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->default('scheduled')
                ->required(),

            Forms\Components\Textarea::make('notes'),
        ]);
    }
}