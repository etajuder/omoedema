<?php
namespace Skrill\Quick;

class SkrillClient
{
    const APP_URL = 'https://voguepay.com/';

    /** @var  SkrillRequest $request */
    private $request;

    /** @var  string $sid */
    private $sid;

    /**
     * SkrillClient constructor.
     * @param SkrillRequest $request
     */
    public function __construct(SkrillRequest $request = null)
    {
        $this->request = $request;
    }

    public function generateSID()
    {
        if (!$this->request) {
            throw new \Exception('Exception, you need to set SkrillRequest!');
        }
        $ch = curl_init(self::APP_URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); //
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); // -0
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->request->toArray());
        $response = curl_exec($ch);
        return $response;
    }

    public function getRedirectUrl()
    {
        if (!$this->sid) {
            $this->sid = $this->generateSID();
        }
        return "https://www.skrill.com/app/payment.pl?sid={$this->sid}";
    }

    /**
     * @return SkrillRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param SkrillRequest $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
}
