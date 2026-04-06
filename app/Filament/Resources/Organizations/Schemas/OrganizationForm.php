<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class OrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('name')
                ->required(),

            Forms\Components\TextInput::make('industry'),

            Forms\Components\TextInput::make('website'),

            Forms\Components\TextInput::make('phone'),

            Forms\Components\Textarea::make('address'),

            Forms\Components\Select::make('status')
                ->options([
                    'prospect' => 'Prospect',
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ])
                ->default('prospect'),
        ]);
    }
}