<?php
namespace App\Traits;

use Illuminate\Support\Arr;

trait EnumTrait
{
    public function label(): string
    {
        return ucwords(str_replace('_', ' ', $this->value));
    }
    /**
     * Get all the names
     *
     * @return array
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get the values of each enum in the class
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Add extra values from external array
     * @param array $extras
     * @return array
     */
    public static function extraValues(array $extras): array
    {
        $values = array_column(self::cases(), 'value');
        return array_merge($values, $extras);
    }

    /**
     * Return name-value associative array
     *
     * @return array
     */
    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    /**
     * Return name-label associative array
     *
     * @return array
     */
    public static function labelArray(): array
    {
        $array = [];
        foreach (self::values() as $value) {
            $array[$value] = self::from($value)->label();
        }

        return $array;
    }

    /**
     * Return a string of the values as for the in rule
     * @return string
     */
    public static function inRule(): string
    {
        $values = self::values();
        return implode(',', $values);
    }

    /**
     * Return a random enum value
     *
     * @return string
     */
    public static function fakerChoice(): string
    {
        return Arr::random(self::values());
    }
}
