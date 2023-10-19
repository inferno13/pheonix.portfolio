<?php

namespace App\Http\Clients;

use Exception;

class WestWallet
{
    private $apiKey = '';
    private $secretKey = '';
    private $basicURL = '';

    public function __construct($apiKey, $secretKey, $basicURL = "https://api.westwallet.info")
    {
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
        $this->basicURL = $basicURL;
    }

    public function currenciesData()
    {
        return $this->makeRequest('/wallet/currencies_data', "GET");
    }

    public function transactionsList($currency = '', $limit = 10, $offset = 0, $type = '', $order = 'desc')
    {
        $data = array();
        $data['currency'] = $currency;
        $data['limit'] = $limit;
        $data['offset'] = $offset;
        $data['type'] = $type;
        $data['order'] = $order;
        return $this->makeRequest('/wallet/transactions', "POST", $data);
    }

    public function walletBalance($currency)
    {
        $data = array();
        $data['currency'] = $currency;
        return $this->makeRequest('/wallet/balance', "GET", $data);
    }

    public function walletBalances()
    {
        return $this->makeRequest('/wallet/balances', "GET");
    }

    public function createWithdrawal($currency, $amount, $address, $destTag = "", $description = "")
    {

        $amount = strval($amount);
        $data = array();
        $data['currency'] = $currency;
        $data['amount'] = $amount;
        $data['address'] = $address;
        $data['dest_tag'] = $destTag;
        $data['description'] = $description;

        return $this->makeRequest('/wallet/create_withdrawal', "POST", $data);
    }

    public function transactionInfo($id)
    {

        $data = array();
        $data['id'] = $id;

        return $this->makeRequest('/wallet/transaction', "POST", $data);
    }

    public function generateAddress($currency, $ipnURL = "", $label = "")
    {

        $data = array();
        $data['currency'] = $currency;
        $data['ipn_url'] = $ipnURL;
        $data['label'] = $label;

        return $this->makeRequest('/address/generate', "POST", $data);
    }

    private function checkErrors($request, $requestJson)
    {
        $exceptions = array(
            "account_blocked" => new AccountBlockedException,
            "bad_address" => new BadAddressException,
            "bad_dest_tag" => new BadDestTagException,
            "insufficient_funds" => new InsufficientFundsException,
            "max_withdraw_error" => new MaxWithdrawException,
            "min_withdraw_error" => new MinWithdrawException,
            "currency_not_found" => new CurrencyNotFoundException,
            "not_found" => new TransactionNotFoundException,
        );
        $statusCode = curl_getinfo($request, CURLINFO_HTTP_CODE);
        if ($statusCode == "401") {
            throw new WrongCredentialsException;
        }
        if ($statusCode == "403") {
            throw new NotAllowedException;
        }
        if (array_key_exists('error', $requestJson)) {
            $error = $requestJson['error'];
            if ($error != "ok") {
                $exception = $exceptions[$error];
                if ($exception) {
                    throw $exception;
                }
                throw new WestWalletAPIException($error);
            }
        }
    }

    private function makeRequest($methodURL, $method, $data = array())
    {
        $timestamp = time();
        if (empty($data)) {
            $body = "";
        } else {
            $body = json_encode($data);
        }
        $requestData = json_encode($data, JSON_UNESCAPED_SLASHES);
        if ($method == "POST") {
            $request = curl_init($this->basicURL . $methodURL);
            curl_setopt($request, CURLOPT_POSTFIELDS, $requestData);
        } else {
            $request = curl_init($this->basicURL . $methodURL . "?" . http_build_query($data));
        }
        if ($requestData != "[]") {
            $hmacMessage = $timestamp . $requestData;
        } else {
            $hmacMessage = $timestamp;
        }
        $signature = hash_hmac("sha256", $hmacMessage, $this->secretKey);
        curl_setopt($request, CURLOPT_FAILONERROR, true);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, 0);
        $headers = array(
            'X-API-KEY: ' . $this->apiKey,
            'Content-Type: application/json',
            'X-ACCESS-SIGN: ' . $signature,
            'X-ACCESS-TIMESTAMP: ' . $timestamp,
        );
        curl_setopt($request, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($request);
        $responseJson = json_decode($response, true);
        $this->checkErrors($request, $responseJson);
        curl_close($request);
        if ($responseJson !== false) {
            return $responseJson;
        }
    }
}

class WestWalletAPIException extends Exception
{

}

class InsufficientFundsException extends WestWalletAPIException
{

}

class CurrencyNotFoundException extends WestWalletAPIException
{

}

class NotAllowedException extends WestWalletAPIException
{

}

class WrongCredentialsException extends WestWalletAPIException
{

}

class TransactionNotFoundException extends WestWalletAPIException
{

}

class AccountBlockedException extends WestWalletAPIException
{

}

class BadAddressException extends WestWalletAPIException
{

}

class BadDestTagException extends WestWalletAPIException
{

}

class MinWithdrawException extends WestWalletAPIException
{

}

class MaxWithdrawException extends WestWalletAPIException
{

}
