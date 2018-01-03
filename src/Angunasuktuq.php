<?php

namespace JeanGuyBillard\Angunasuktuq;

use Curl\Curl;

/**
 *  Angunasuktuq Saas Client
 *
 * @author Jean-Guy Billard
 */
class Angunasuktuq
{
    /** @var array $options */
    private $options = [
        'saas-server-address' => null,
        'saas-api-key' => null,
        'account-id' => null,
        'account-name' => null,
        'report-id' => 'default',
    ];

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
    public function __construct($options = [])
    {
        $this->options = $options;
    }

    /**
     * @param $mapping
     */
    public function setColumnMapping($mapping = self::NCSA_COMMON_COLUMN_MAPPING_OPT_HOST)
    {
        $this->mapping = $mapping;
    }

    /**
     * @param $filePath
     * @return Curl
     * @throws \Exception
     */
    public function load($filePath)
    {
        assert(isset($this->options['saas-server-address']));
        assert(isset($this->options['saas-api-key']));
        assert(isset($this->options['account-id']));
        assert(isset($this->options['account-name']));
        assert(isset($this->options['report-name']));

        //upload file
        $curl = new Curl();
        $curl->setHeader('Content-Type','multipart/form-data');
        $curl->setHeader('Authorization', "Bearer " . $this->options['saas-api-key']);
        $curl->post($this->options['saas-server-address'] . "/{$this->options['account-name']}/data/{$this->options['report-name']}/sync", array(
            'data' => "@$filePath",
            'account-id' => $this->options['account-id']
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
        assert(isset($this->options['saas-server-address']));
        assert(isset($this->options['saas-api-key']));
        assert(isset($this->options['account-id']));
        assert(isset($this->options['account-name']));
        assert(isset($this->options['report-name']));

        $curl = new Curl();
        $curl->setHeader('Content-Type','multipart/form-data');
        $curl->setHeader('Authorization', "Bearer " . $this->options['saas-api-key']);
        $curl->get($this->options['saas-server-address'] . "/{$this->options['account-name']}/data/{$this->options['report-name']}/suspects", array(
            'mapping' => $this->mapping,
            'account-id' => $this->options['account-id']
        ));

        if ($curl->error) {
            throw new \Exception($curl->error_code);
        } else {
            $result = $curl->response;
        }
        return $result;
    }
}