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

    /** @var array $mapping */
    private $mapping = self::CUSTOM_COLUMN_MAPPING;

    /**
     * http://publib.boulder.ibm.com/tividd/td/ITWSA/ITWSA_info45/en_US/HTML/guide/c-logs.html#common
     *
     * host rfc931 username date:time request statuscode bytes
     *
     */
    CONST NCSA_COMMON_COLUMN_MAPPING_OPT_USERNAME =
        [
            'customer-id' => 'username',
            'transaction-id' => 'request',
            'date' => 'date:time',
            'total' => 'bytes',

        ];

    CONST NCSA_COMMON_COLUMN_MAPPING_OPT_HOST =
        [
            'customer-id' => 'host',
            'transaction-id' => 'request',
            'date' => 'date:time',
            'total' => 'bytes',
        ];

    CONST CUSTOM_COLUMN_MAPPING =
        [
            'customer-id' => 'customer-id',
            'transaction-id' => 'transaction-id',
            'date' => 'date',
            'total' => 'total',
        ];

    /**
     * Angunasuktuq constructor.
     *
     * @param $name
     */
    public function __construct($name = 'default')
    {
        $this->name = $name;
        $this->setConfiguration(__DIR__);
    }

    /**
     * @param $mapping
     */
    public function setColumnMapping($mapping = self::NCSA_COMMON_COLUMN_MAPPING_OPT_HOST)
    {
        $this->mapping = $mapping;
    }

    /**
     * @param $envPath
     * @return array|false|string
     */
    public function setConfiguration($envPath = __DIR__)
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
        $curl->post(getenv('Angunasuktuq-saas-server-address') . "/data/$this->name/sync", array(
            'data' => "@$filePath"
        ));

        if ($curl->error) {
            throw new \Exception($curl->error_code);
        } else {
            $result = $curl->response;
        }
        return $result;
    }

    /**
     * Performing packet analysis, time analisis, and profile analysis
     *
     * @return string
     * @throws \Exception
     */
    public function getSuspects()
    {
        $curl = new Curl();
        $curl->get(getenv('Angunasuktuq-saas-server-address') . "/data/$this->name/suspects", array(
            'mapping' => $this->mapping,
        ));

        if ($curl->error) {
            throw new \Exception($curl->error_code);
        } else {
            $result = $curl->response;
        }
        return $result;
    }
}