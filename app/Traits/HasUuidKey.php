<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasUuidKey
{
    public static function bootHasUuidKey(): void
    {
        static::creating(function (Model $model) {
            $keyName = $model->getKeyName();
            if (empty($model->$keyName)) {
                $model->$keyName = Str::uuid()->toString();
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
