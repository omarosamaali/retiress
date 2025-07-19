<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $targetLanguages;

    public function __construct()
    {
        $this->targetLanguages = config('app_languages.list');
    }
}
