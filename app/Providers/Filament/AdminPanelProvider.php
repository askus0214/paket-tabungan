<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('Tabungan Lebaranku')
            ->homeUrl('/')
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
                fn(): string => Blade::render('
        <nav style="position: fixed; top: 0; left: 0; right: 0; background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(16px); border-bottom: 1px solid #18181b; z-index: 1000; padding: 18px 24px;">
            <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
                <a href="/" style="font-family: sans-serif; font-size: 20px; font-weight: 800; color: #f4f4f5; text-decoration: none;">
                    🌙 Tabungan<span style="color: #f59e0b;">Lebaranku</span>
                </a>
                <div style="display: flex; gap: 28px; align-items: center;">
                    <a href="/#beranda" style="color: #71717a; text-decoration: none; font-size: 14px; font-weight: 500;">Beranda</a>
                    <a href="/#tentang" style="color: #71717a; text-decoration: none; font-size: 14px; font-weight: 500;">Mengapa Kami</a>
                    <a href="/#kontak" style="color: #71717a; text-decoration: none; font-size: 14px; font-weight: 500;">Hubungi Kami</a>
                </div>
            </div>
        </nav>
    ')
            )
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
