<?php


namespace Advans\Api\ValidadorCFDI;

class ValidadorCFDI {

    protected $config;

    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function version() {
        return $this->call('version');
    }

    public function validar($xml) {
        return json_decode($this->call('v1/validar', 'POST', $xml));
    }

    protected function call($method, $verb = 'GET', $params = null) {
        $verb = strtoupper($verb);
        $url = $this->config->base_url . $method . ($verb == 'GET' && $params ? '?' . http_build_query($params) : '');
        $curl = curl_init();
        $postfields = null;
        if ($verb == 'POST') {
            $postfields = gettype($params) == 'array' ? json_encode($params) : $params;
        }
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $verb,
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => [
                gettype($params) == 'array' ? 'Content-Type: application/json' : 'Content-Type: text/xml',
                'Authorization: Bearer ' . $this->config->key
            ],
        ]);

        $result = @curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_code != 200) {
            throw new ValidadorCFDIException('El servicio regresó un código de error ' . $http_code . ' ' . $result, $http_code);
        }
        curl_close($curl);
        return $result;
    }
}