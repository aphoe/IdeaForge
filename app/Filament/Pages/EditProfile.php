<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Auth\Pages\EditProfile as FilamentEditProfile;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;

class EditProfile extends FilamentEditProfile
{
    /*protected static ?string $navigationIcon = 'heroicon-o-document-text';*/

    protected string $view = 'filament.pages.edit-profile';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFirstNameFormComponent(),
                $this->getSurnameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCurrentPasswordFormComponent(),
            ]);
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
