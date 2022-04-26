<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
       'key',
       'value',
   ];

    public static function chargeConfig()
    {
        $settings = Cache::get('db_setting', []);

        if ($settings instanceof Collection) {
            collect($settings)
                ->each(fn ($setting) => app('config')->set(['settings.' . $setting->key => $setting->value]));

        }
          dump($settings);
        return $settings;
    }

    public static function refreshCache()
    {
        Cache::forget('db_setting');
        // Cache::flush();
        Cache::rememberForever('db_setting', fn() => static::query()->get()->toBase());

        return self::chargeConfig();
    }
}
