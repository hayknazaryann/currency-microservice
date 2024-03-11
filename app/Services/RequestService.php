<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RequestService
{
    /**
     * @param string $url
     * @param string $date
     * @param int $maxAttempts
     * @param int $retryDelayMilliseconds
     * @return array
     * @throws \Exception
     */
    public function sendXmlRequest(string $url, string $date, int $maxAttempts = 3, int $retryDelayMilliseconds = 1000): array
    {
        return retry(
            $maxAttempts,
            function () use ($url, $date) {
                return $this->makeXmlRequest($url, $date);
            },
            $retryDelayMilliseconds
        );
    }

    /**
     * @param string $url
     * @param string $date
     * @return array
     * @throws \Exception
     */
    private function makeXmlRequest(string $url, string $date): array
    {
        try {
            $response = Http::get($url , [
                'date_req' => $date
            ]);

            if ($response->successful()) {
                $xmlData = simplexml_load_string($response->body());
                $json = json_encode($xmlData);

                return json_decode($json, true);
            } else {
                $errMsg = 'HTTP request was not successful. Status code: ' . $response->status();
                Log::error($errMsg);
                throw new \Exception($errMsg);
            }
        } catch (\Exception $exception) {
            Log::error('Error in sendXmlRequest: ' . $exception->getMessage());
            throw $exception;
        }
    }
}
