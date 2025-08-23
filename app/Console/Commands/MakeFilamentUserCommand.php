<?php

namespace App\Console\Commands;

use Filament\Commands\MakeUserCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Attribute\AsCommand;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

#[AsCommand(name: 'make:filament-user')]
class MakeFilamentUserCommand extends MakeUserCommand
{
    protected $signature = 'make:filament-user
                            {--first_name= : The firstname of the user}
                            {--surname= : The surname of the user}
                            {--email= : A valid and unique email address}
                            {--password= : The password for the user (min. 8 characters)}';

    /**
     * @return array{'first_name': string, 'surname': string, 'name': string, 'email': string, 'password': string}
     */
    protected function getUserData(): array
    {
        return [
            'first_name' => $this->options['first_name'] ?? text(
                    label: 'First name',
                    required: true,
                ),

            'surname' => $this->options['surname'] ?? text(
                    label: 'Surname',
                    required: true,
                ),

            'email' => $this->options['email'] ?? text(
                    label: 'Email address',
                    required: true,
                    validate: fn (string $email): ?string => match (true) {
                        ! filter_var($email, FILTER_VALIDATE_EMAIL) => 'The email address must be valid.',
                        static::getUserModel()::where('email', $email)->exists() => 'A user with this email address already exists',
                        default => null,
                    },
                ),

            'password' => Hash::make($this->options['password'] ?? password(
                label: 'Password',
                required: true,
            )),
        ];
    }
}
