<?php

class MomoPaymentModel
{
    private $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    private $partnerCode = 'MOMO';
    private $accessKey = 'F8BBA842ECF85';
    private $secretKey = 'K951B6PE1waDMi640xX08PD3vg6EkVlz';
    private $ipnUrl = 'http://localhost/duanweb2/ipn';
    private $redirectUrl = 'http://localhost/duanweb2/success';

    public function createPayment($orderId, $amount,$items,$deliveryInfo,$userInfo, $orderInfo)
    {
        $requestId = time() . "";
        $orderId = $orderId ?: time();
        $extraData = "";

        $rawHash = "accessKey=$this->accessKey"
         . "&amount=$amount"
         . "&extraData=$extraData"
         . "&ipnUrl=$this->ipnUrl"
         . "&orderId=$orderId"
         . "&orderInfo=$orderInfo"
         . "&partnerCode=$this->partnerCode"
         . "&redirectUrl=$this->redirectUrl"
         . "&requestId=$requestId"
         . "&requestType=payWithMethod"
         ;


        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);

        $data = [
            'partnerCode' => $this->partnerCode,
            'accessKey' => $this->accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $this->redirectUrl,
            'ipnUrl' => $this->ipnUrl,
            'extraData' => $extraData,
            'requestType' => 'payWithMethod',
            'items' => $items,
            'deliveryInfo' => [
                'deliveryAddress' => $deliveryInfo['deliveryAddress'],
                'deliveryFee' => (int)$deliveryInfo['deliveryFee'],
            ],
            'userInfo' => [
                'name' => $userInfo['name'],
                'phoneNumber' => $userInfo['phone'],
            ],
            'lang' => 'vi',
            'signature' => $signature,
            
        ];
        file_put_contents(__DIR__ . '/momo_log.txt', json_encode($data), FILE_APPEND);
        file_put_contents(__DIR__ . '/momo_rawhash.txt', $rawHash . PHP_EOL, FILE_APPEND);
        $result = $this->execPostRequest($this->endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        return $jsonResult;
    }

    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
