<?php


namespace Bedivierre\Enlighten\Insider\API\Order;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenEvent;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

class OrderCreate extends OrderEvent
{
    protected $function = 'create';
}