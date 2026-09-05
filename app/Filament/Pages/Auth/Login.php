<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse;

class Login extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent()
                    ->revealable(), // Icon mata show/hide password
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    // Paksa Filament redirect ke Landing Page (/) saat admin Logout
    public function getLogoutResponse(): LogoutResponse
    {
        return new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/');
            }
        };
    }
}
