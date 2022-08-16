<?php

namespace App\Enums;

// TODO: unless planned there are going to be more visibilities
//       move this to a boolean attribute on the quiz model
enum QuizVisibility: string
{
    case Public = 'public';
    case Private = 'private';
}
