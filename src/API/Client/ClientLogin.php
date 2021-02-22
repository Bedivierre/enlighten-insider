<?php


namespace Bedivierre\Enlighten\Insider\API\Client;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

class ClientLogin extends EnlightenBase
{
    protected $controller = 'client';
    protected $function = 'login';
    private $id = 0;
    private $clientData = [];

    public function __construct($id, $clientData = [])
    {
        parent::__construct();
        $this->setClientId($id);

        if(!is_array($clientData))
            return;
        foreach ($clientData as $d){
            if(!is_array($d) || !isset($d['type']) || !isset($d['value']))
                continue;
            $this->addClientData($d['type'], $d['value'], EnlightenUtility::array_path($d, 'data'));
        }
    }
    public function addClientData($type, $value, $additionalData = null){
        $this->createDataEntry($this->clientData, $type, $value, $additionalData);
    }

    public function setClientId($id){
        $this->id = $id;
    }
    public function send(){
        $this->data['data'] = $this->clientData;
        $this->data['id'] = $this->id;
        return parent::send();
    }

}