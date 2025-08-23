<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ModelManager
{
    /**
     * Create a unique identifier
     *
     * @param Model $model
     * @return string
     */
    public function identifier(Model $model): string
    {
        $identifier = Str::uuid7();

        while(\DB::table($model->getTable())->where('identifier', $identifier)->exists()){
            $identifier = Str::uuid7();
        }

        return $identifier;
    }

    /**
     * Create a unique slug
     *
     * @param Model $model
     * @param string $title
     * @return string
     */
    public function slug(Model $model, string $title): string
    {
        $slug = Str::slug($title);
        $count = 1;

        while(\DB::table($model->getTable())->where('slug', $slug)->exists()){
            $slug = Str::slug($title . '-' . $count);
            $count++;
        }

        return $slug;
    }
}
