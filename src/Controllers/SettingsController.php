<?php

namespace Silvanite\AgencmsSettings\Controllers;

use Illuminate\Http\Request;
use Silvanite\AgencmsSettings\Settings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $section = null)
    {
        return Settings::where('section', '=', $section)
            ->get()
            ->mapWithKeys(function ($item) {
                $returnValue = json_decode($item['value']);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $returnValue = $item['value'];
                }

                return [$item['key'] => $returnValue];
            });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, string $section = null)
    {
        collect($request->all())->each(function ($value, $key) {
            if (is_array($value)) {
                $value = json_encode($value);
            }

            Settings::firstOrCreate(['key' => $key, 'section' => $section])
                ->update(['value' => $value]);
        });
    }
}
