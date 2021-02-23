<?php


namespace Bedivierre\Enlighten\Insider\Core;


class EnlightenEvent extends EnlightenBase
{
    protected $eventData = [];
    public function __construct($id, $eventData = [], $phone = '')
    {
        parent::__construct();
        $this->setOwnerId($id);
        $this->setOwnerPhone($phone);
        foreach ($eventData as $d){
            if(!is_array($d) || !isset($d['type']) || !isset($d['value']))
                continue;
            $this->addEventData($d['type'], $d['value'], EnlightenUtility::array_path($d, 'data'));
        }
    }

    public function setOwnerId($id){
        $this->addBaseDataValue('id', $id);
    }
    public function setOwnerPhone($phone){
        $this->addBaseDataValue('phone', $phone);
    }

    public function addEventData($type, $value, $data = null){
        $this->createDataEntry($this->eventData, $type, $value, $data);
    }

    public function send()
    {
        $this->addBaseDataValue('data', $this->eventData);
        return parent::send();
    }
}