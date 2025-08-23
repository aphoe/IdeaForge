<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\EditProfile as FilamentEditProfile;

class EditProfile extends FilamentEditProfile
{
    /*protected static ?string $navigationIcon = 'heroicon-o-document-text';*/

    protected static string $view = 'filament.pages.edit-profile';

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getFirstNameFormComponent(),
                        $this->getSurnameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->operation('edit')
                    ->model($this->getUser())
                    ->statePath('data')
                    ->inlineLabel(! static::isSimple()),
            ),
        ];
    }

    protected function getFirstNameFormComponent(): Component
    {
        return TextInput::make('first_name')
            ->label('First name')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getSurnameFormComponent(): Component
    {
        return TextInput::make('surname')
            ->label('Surname')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label(__('filament-panels::pages/auth/edit-profile.form.email.label'))
            ->readOnly()
            ->disabled()
            ->email()
            ->required()
            ->maxLength(255)
            ->unique(ignoreRecord: true);
    }
}
