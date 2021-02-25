<?php


namespace Bedivierre\Enlighten\Insider\API\Client;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

class ClientRegister extends EnlightenBase
{
    protected $controller = 'client';
    protected $function = 'register';

    private $clientIndex = -1;
    private $clients = [];

    public function __construct($id = 0, $clientData = [])
    {
        parent::__construct();
        $this->addClient($id,  $clientData);
    }

    /**
     * @param string|integer $id
     * @param array $data should be array of entities ['type'=>'xxx', 'value'=>'yyy', 'data'=>'zzz'].
     * 'data' value is not mandatory.
     * @throws \Exception
     */
    public function addClient($id, $clientData = [], $login = null, $phone = null){
        $this->clients[] = [
            'data'=>[],
        ];
        $this->clientIndex = $this->count() - 1;
        $this->setClientId($id);
        if($login)
            $this->setClientLogin($login);
        if($phone)
            $this->setClientPhone($phone);
        if(!is_array($clientData))
            return;
        foreach ($clientData as $d){
            if(!is_array($d) || !isset($d['type']) || !isset($d['value']))
                continue;
            $this->addClientData($d['type'], $d['value'], EnlightenUtility::array_path($d, 'data'));
        }
    }
    public function setClientId($id, $index = null){
        $index = $this->getIndex($index);
        if(!$id || $id < 0)
            return;
        $this->clients[$index]['id'] = trim($id);
    }
    public function setClientCreated($timestamp, $index = null){
        $index = $this->getIndex($index);
        if(!$timestamp)
            return;
        $this->clients[$index]['created'] = $timestamp;
    }
    public function setClientLogin($login, $index = null){
        $index = $this->getIndex($index);
        if(!trim($login))
            return;
        $this->clients[$index]['login'] = $login;
    }
    public function setClientPhone($phone, $index = null){
        $index = $this->getIndex($index);
        if(!trim($phone))
            return;
        $this->clients[$index]['phone'] = $phone;
    }
    public function addClientData($type, $value, $additionalData = null, $index = null){
        $index = $this->getIndex($index);

        $arr = $this->clients[$index]['data'];
        $this->createDataEntry($arr, $type, $value, $additionalData);
        $this->clients[$index]['data'] = $arr;
    }

    public function getClientData($index = null){
        if($index === null)
            return $this->clients;
        if(isset($this->clients[$index]))
            return $this->clients[$index];
        return null;
    }
    public function count(){
        return count($this->clients);
    }

    private function validate(){

    }
    public function send(){

        $this->addBaseDataValue('clients', $this->clients);
        return parent::send();
    }


    function getIndex($index = null){
        if($index === null)
            $index = $this->clientIndex;
        if(!isset($this->clients[$index]))
            throw new \Exception('Wrong client index');
        return $index;
    }
}