<?php

namespace masterix21\html2pdf;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class Facade extends IlluminateFacade
{
    protected static function getFacadeAccessor()
    {
        return 'html2pdf.wrapper';
    }
}