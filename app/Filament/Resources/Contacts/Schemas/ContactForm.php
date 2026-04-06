<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('organization_id')
                ->relationship('organization', 'name')
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('name')
                ->required(),

            Forms\Components\TextInput::make('email')
                ->email(),

            Forms\Components\TextInput::make('phone'),

            Forms\Components\TextInput::make('job_title'),
        ]);
    }
}