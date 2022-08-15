<?php

namespace App\Enums;

enum AuthMethodType: string
{
    case Email = 'email';
    case GitHub = 'github';
}
