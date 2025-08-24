<?php

namespace App\Classes;

class ValidationRule
{
    /**
     * Regex for domain name validation
     *
     * @return string
     */
    public function domainNameRegex(): string
    {
        return '/^(?:[a-z0-9](?:[a-z0-9-æøå]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/isu';
    }
}
