<?php

namespace App\Parser;

use App\Proxy\ProxyList;
use App\Proxy\UserAgentList;

class Parser
{
    private $url;
    private $use_proxy;
    private $timeout;
    private $returnHtml;
    private $returnJson;
    private $returnCode;
    private $returnErrors;
    private $returnParseTime;
    private $isSuccess;

    public $proxy;
    public $userAgent;

    public function __construct(
        $url = null,
        $use_proxy = true,
        $timeout = 8,
        $proxy = null
    )
    {
        $this->url = $url;
        $this->use_proxy = $use_proxy;
        $this->timeout = $timeout;
        $this->proxy = $proxy;
        $this->request();
    }

    public function request()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_REFERER, $this->url);
        curl_setopt($curl, CURLOPT_URL, $this->url);

        if ($this->use_proxy) {
            curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
            curl_setopt($curl, CURLOPT_PROXY, $this->proxyString());
        }
        //UserAgent
        curl_setopt($curl, CURLOPT_USERAGENT, $this->userAgentString());
        curl_setopt($curl, CURLOPT_TIMEOUT, 60 * 5);
        //Options
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        $this->returnHtmll = curl_exec($curl);
        $this->returnJson = json_decode($this->returnHtmll);
        $this->returnCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $this->returnParseTime = "time: ". curl_getinfo($curl, CURLINFO_TOTAL_TIME) . "s.";
        $this->returnErrors = curl_error($curl);
        curl_close($curl);
    }

    public function proxyString(): ?string
    {
        if (!$this->proxy) {
            $this->proxy = ProxyList::getProxy();
        }

        return $this->proxy['string'] ?: NULL;
    }

    public function userAgentString(): ?string
    {
        $this->userAgent = UserAgentList::getUserAgent();
        return $this->userAgent['string'] ?: NULL;
    }

    public function getJson()
    {
        return $this->returnJson;
    }
}
