<?php


namespace Bedivierre\Enlighten\Insider\API\Client;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenEvent;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

abstract class ClientEvent extends EnlightenEvent
{
    protected $controller = 'client';
    public function __construct($clientId = null, $phone = null, $clientData = [])
    {
        parent::__construct(null, null, []);
        if(!$clientId && !$phone)
            return;
        $this->addNewClient($clientId, $phone, $clientData);
    }
    public function addNewClient($clientId, $phone = null, $clientData = [])
    {
        parent::addNew($clientId, $phone, $clientData);
    }
}