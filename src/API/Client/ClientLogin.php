<?php


namespace Bedivierre\Enlighten\Insider\API\Client;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenEvent;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

class ClientLogin extends EnlightenEvent
{
    protected $controller = 'client';
    protected $function = 'login';
}