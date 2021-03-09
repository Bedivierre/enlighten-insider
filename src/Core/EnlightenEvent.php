<?php


namespace Bedivierre\Enlighten\Insider\Core;


class EnlightenEvent extends EnlightenBase
{
    protected $dataContainerName = 'events';
    public function __construct($id = null, $phone = '', $eventData = [])
    {
        parent::__construct();
        if($id || $phone) {
            $this->addNew($id, $phone, $eventData);
            $this->setCreatedDate(time());
        }
    }
}