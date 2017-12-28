<?php

namespace JeanGuyBillard\Angunasuktuq;

use Curl\Curl;
use Dotenv\Dotenv;

/**
 *  Angunasuktuq Saas Client
 **
 * @author Jean-Guy Billard
 */
class Angunasuktuq
{
    /** @var array $config */
    private $config = [];

    /** @var array $name */
    private $name = [];

    /**
     * Angunasuktuq constructor.
     *
     * @param $name
     */
    public function __construct($name='default')
    {
        $this->name = $name;
    }

    /**
     * @param $envPath
     * @return array|false|string
     */
    public function configuration($envPath)
    {
        $dotenv = new Dotenv($envPath);
        $dotenv->load();
        $this->config = getenv('Angunasuktuq-saas-server-address');
        return $this->config;
    }

    /**
     * @param $filePath
     * @return Curl
     * @throws \Exception
     */
    public function load($filePath)
    {
        //upload file
        $curl = new Curl();
        $curl->post(getenv('Angunasuktuq-saas-server-address')."/data/$this->name/sync", array(
            'data' => "@$filePath",
        ));

        if ($curl->error) {
            throw new \Exception($curl->error_code);
        }
        else {
            $result = $curl->response;
        }
        return $result;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getSuspects()
    {
        $curl = new Curl();
        $curl->get(getenv('Angunasuktuq-saas-server-address')."/data/$this->name/suspects");

        if ($curl->error) {
            throw new \Exception($curl->error_code);
        }
        else {
            $result = $curl->response;
        }
        return $result;
    }
}