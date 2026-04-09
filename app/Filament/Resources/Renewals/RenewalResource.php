<?php
namespace App\Filament\Resources\Renewals;
use App\Filament\Resources\Renewals\Pages\CreateRenewal;
use App\Filament\Resources\Renewals\Pages\EditRenewal;
use App\Filament\Resources\Renewals\Pages\ListRenewals;
use App\Models\Renewal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
class RenewalResource extends Resource
{
    protected static ?string $model = Renewal::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;
    protected static ?string $recordTitleAttribute = 'contract_title';
    protected static ?int $navigationSort = 5;
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin']);
    }
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['admin']);
    }
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('organization_id')
                ->relationship('organization', 'name')
                ->required()
                ->searchable(),
            TextInput::make('contract_title')
                ->required()
                ->maxLength(255),
            DatePicker::make('renewal_due_date')
                ->required(),
            Select::make('status')
                ->options([
                    'upcoming' => 'Upcoming',
                    'renewed' => 'Renewed',
                    'cancelled' => 'Cancelled',
                ])
                ->default('upcoming')
                ->required(),
            TextInput::make('renewal_amount')
                ->numeric()
                ->prefix('$'),
            Textarea::make('notes')
                ->rows(3)
                ->columnSpanFull(),
        ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('organization.name')
                    ->label('Organization')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('contract_title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('renewal_due_date')
                    ->label('Due Date')
                    ->date()
                    ->sortable()
                    ->color(fn ($record) => $record->renewal_due_date->isPast() ? 'danger' :
                        ($record->renewal_due_date->diffInDays(now()) <= 30 ? 'warning' : 'success')),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'upcoming' => 'warning',
                        'renewed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('renewal_amount')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('reminder_30_sent')
                    ->label('30d Alert')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Sent' : 'Pending'),
                TextColumn::make('reminder_90_sent')
                    ->label('90d Alert')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Sent' : 'Pending'),
                TextColumn::make('reminder_150_sent')
                    ->label('150d Alert')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Sent' : 'Pending'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'upcoming' => 'Upcoming',
                        'renewed' => 'Renewed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->defaultSort('renewal_due_date', 'asc');
    }
    public static function getRelations(): array
    {
        return [];
    }
    public static function getPages(): array
    {
        return [
            'index' => ListRenewals::route('/'),
            'create' => CreateRenewal::route('/create'),
            'edit' => EditRenewal::route('/{record}/edit'),
        ];
    }
}
