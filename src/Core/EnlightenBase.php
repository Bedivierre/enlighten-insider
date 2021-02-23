<?php


namespace Bedivierre\Enlighten\Insider\Core;


class EnlightenBase
{
    protected $controller = 'default';
    protected $function = 'func';
    protected $method = 'post';

    protected $data = [];

    public function __construct()
    {
    }

    /** Устанавливает значение в корень отправляемых данных. Можно использовать dot-нотацию.
     * @param $key
     * @param $value
     * @param bool $overwrite
     */
    public function addBaseDataValue($key, $value, $overwrite = true){
        if(EnlightenUtility::array_path($this->data, $key) && !$overwrite)
            return;
        $this->data = EnlightenUtility::array_add($this->data, $key, $value, $overwrite);
    }

    public function getFunction(){
        return join('/', [$this->controller, $this->function]);
    }
    public function getMethod(){
        return strtolower($this->method);
    }

    /**
     * Возвращает полный путь к API
     * @return string
     */
    public function getFullPath(){
        $host = self::getHost();
        $apiPath = self::getApiPath();
        $func = $this->getFunction();
        return join('/', [$host, $apiPath, $func]);
    }

    /**
     * Отправляет запрос в указанную функцию через указанный же протокол.
     * @return string|array
     * @throws \Exception
     */
    public function send(){
        return $this->_send($this->data);
    }
    protected function _send($data){
        if(!is_array($data))
            throw new \Exception('EnlightenBase::send($data) should get array as argument');
        $methods = ['get', 'post'];
        $method = $this->getMethod();
        if(!in_array($method, $methods))
            $method = 'post';
        return $this->{$method}($data);
    }



    private function getHeaders(){
        $headers = [];
        $headers[] ='Content-Type: ' . "application/json";
        $headers[] ='Accept: ' . "application/json";
        $headers[] ='Authorization: ' . "Bearer " . self::getToken();
        return $headers;
    }
    /**
     * Производит GET-запрос по указанному адресу с указанными параметрами.
     * @param array $data параметры к запросу.
     * @return string|array Возвращает строку или массив (если результат - валидный json),
     * представляющий результат запроса.
     * @throws \Exception
     */
    protected function get($data = []){
        if(!is_array($data))
            throw new \Exception('EnlightenBase::get($data) should get array as argument');
        $url = $this->getFullPath();
        $query = http_build_query($data);
        $ch = curl_init();
        $uri = $url. ($query ? "?".$query : '');
        $headers = $this->getHeaders();
        $defaults = array(
            CURLOPT_URL => $uri,
            CURLOPT_HEADER => 1,
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_HTTPHEADER => $headers,
        );
        curl_setopt_array($ch, $defaults);

        return $this->processResult($ch);
    }

    /**
     * Производит GET-запрос по указанному адресу с указанными параметрами.
     * @param array $data параметры к запросу.
     * @return string|array Возвращает строку или массив (если результат - валидный json),
     * представляющий результат запроса.
     * @throws \Exception
     */
    protected function post($data = []){
        if(!is_array($data))
            throw new \Exception('EnlightenBase::post($data) should get array as argument');
        $url = $this->getFullPath();
        $ch = curl_init();
        $body = empty($data) ? '' : json_encode($data);
        $headers = $this->getHeaders();
        $headers[] ='Content-Length: ' . strlen($body);
        $defaults = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HEADER => 1,
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_HTTPHEADER => $headers,
        );
        curl_setopt_array($ch, $defaults);

        return self::processResult($ch);
    }

    public static function getHost(){
        return trim(EnlightenConfig::$protocol, '/')
            . '://' . trim(EnlightenConfig::$host, '/');
    }
    public static function getApiPath(){
        return trim(EnlightenConfig::$pathToAPI, '/')
            . '/' . trim(EnlightenConfig::$version, '/');
    }
    public static function getToken(){
        return EnlightenConfig::$token;
    }

    static function processResult($ch){
        $result = curl_exec($ch);
        if(curl_error($ch))
        {
            curl_close($ch);
            throw new \Exception('Ошибка при запросе: ' . curl_error($ch));
        }
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($result, $header_size);
        $return = $body ? json_decode($body, true) : [];
        if(!$return && !is_array($return))
            $return = $body;
        curl_close($ch);
        return $return;
    }

    protected function createDataEntry(&$dataContainer, $type, $value, $additionalData = null){
        $type = trim($type);
        $value = trim($value);
        $additionalData = trim($additionalData);

        //if data type not existed
        if(!isset($dataContainer[$type])){
            $dataContainer[$type] = [];
        }

        $dataValue = [
            'value' => $value,
        ];
        if($additionalData)
            $dataValue['data'] = $additionalData;

        $dataContainer[$type][] = $dataValue;
    }

    public static function getDataType($key){
        return EnlightenData::getType($key);
    }
}