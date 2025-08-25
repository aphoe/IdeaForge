<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum NavigationGroup: string
{
    use EnumTrait;

    case Idea = 'idea';
    case Project = 'project';
    case Task = 'task';

}
