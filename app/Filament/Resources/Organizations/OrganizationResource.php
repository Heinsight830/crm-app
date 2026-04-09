public static function shouldRegisterNavigation(): bool
{
    return auth()->check() && auth()->user()->hasAnyRole(['admin', 'sales', 'trainer']);
}

public static function canAccess(): bool
{
    return auth()->check() && auth()->user()->hasAnyRole(['admin', 'sales', 'trainer']);
}
