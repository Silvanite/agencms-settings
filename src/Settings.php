<?php

namespace Silvanite\AgencmsSettings;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'section',
        'key',
        'value',
    ];

    /**
     * Retrieve a saved setting. Will cast to array if required.
     *
     * @param string $section
     * @param string $key
     * @param mixed $default
     * @return string|array
     */
    public static function get(string $section, string $key, $default = null)
    {
        $setting = self::where('section', '=', $section)
            ->where('key', '=', $key)
            ->first();

        if (!$setting) {
            return $default;
        }

        $returnValue = json_decode($returnPlain = $setting->value, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $returnValue = $returnPlain;
        }

        return $returnValue;
    }
}
