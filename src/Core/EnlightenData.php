<?php


namespace Bedivierre\Enlighten\Insider\Core;

class EnlightenData
{
    public static $types = [
        'personal' => [
            'first_name'=>'first_name',
            'last_name'=>'last_name',
            'middle_name'=>'middle_name',
            'birth_date'=>'birth_date',
            'passport'=>'passport',
            'car_licence'=>'car_licence',
            'snils'=>'snils',
            'soldier_num'=>'soldier_num',
            'payment_card'=>'payment_card',
        ],
        'common'=>[
            'message'=>'message',
        ],
        'contacts'=>[
            'address'=>'address',
            'email'=>'email',
            'phone'=>'phone',
            'website'=>'website',
            'place'=>'place',
            'vk'=>'vk',
            'instagram'=>'instagram',
            'fb'=>'fb',
            'twittwer'=>'twittwer',
        ],

        'discount_card'=>[
            'sampo'=>'discount_card.sampo',
            'obriens'=>'discount_card.obriens',
            'fourcheeses'=>'discount_card.fourcheeses',
            'fazenda'=>'discount_card.fazenda',
        ],
        'promocode'=>[
            'code'=>'promocode.code',
            'discount'=>'promocode.discount',
        ],
        'order'=>[
            'id'=>'order.id',
            'sum'=>'order.sum',
            'position_count'=>'order.position_count',
            'currency'=>'order.currency',
            'payment_status'=>'order.payment_status',
        ],
        'network'=>[
            'ip'=>'network.ip',
            'mac'=>'network.mac',
        ],
    ];
    public static $places = [
        'sampo'=>'sampo',
        'pizza'=>'pizza',
        'pub1'=>'pub1',
        'pub2'=>'pub2',
        'pub3'=>'pub3',
        'pub4'=>'pub4',
        'fazenda'=>'fazenda',
        'fourcheeses'=>'fourcheeses',
    ];
    public static $websites = [
        'sampo'=>'sampo',
        'pizza'=>'pizza',
        'obriens'=>'obriens',
        'fazenda'=>'fazenda',
        'fourcheeses'=>'fourcheeses',
    ];


    public static function getType($type){
        $t =  EnlightenUtility::array_path(self::$types, $type);
        return $t ?? 'common';
    }
}