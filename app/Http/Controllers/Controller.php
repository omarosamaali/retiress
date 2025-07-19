<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $targetLanguages = [
        'ar' => 'العربية',
        'en' => 'الإنجليزية',
    ];
}
