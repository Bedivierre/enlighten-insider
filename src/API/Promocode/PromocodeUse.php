<?php


namespace Bedivierre\Enlighten\Insider\API\Promocode;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenEvent;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

class PromocodeUse extends PromocodeEvent
{
    protected $function = 'use';
}