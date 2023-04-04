<?php

namespace Mojeed\BuckhillCurrencyConverter\Transporters;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Mojeed\BuckhillCurrencyConverter\Services\Concerns\Transportable;
use Mojeed\BuckhillCurrencyConverter\Contracts\Transporters\TransporterContract;
use Mojeed\BuckhillCurrencyConverter\Services\Enums\Transporter\Method;
use Mojeed\BuckhillCurrencyConverter\Services\XMLToArray;
use Psr\Http\Message\ResponseInterface;

class HttpTransporter implements TransporterContract
{
    use Transportable;


    /**
     * @param string $method
     * @param array $payload
     * @return array
     * @throws Exception
     */
    public function requestObject(string $method, array $payload = []): array
    {
        try {
            $response = $this->request($method, $payload);
            return $this->handledResponse($response);
        } catch (GuzzleException  $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param array $payload
     * @param string $method
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function request(string $method, array $payload): ResponseInterface
    {
        return match ($method) {
            Method::POST()->value => $this->client
                ->post($this->uri, $payload),
            Method::DELETE()->value => $this->client
                ->delete($this->uri, $payload),
            Method::PUT()->value => $this->client
                ->put($this->uri, $payload),
            default => $this->client
                ->get($this->uri, $payload)
        };
    }

    protected function responseIsSuccessful(ResponseInterface $response): bool
    {
        return in_array($response->getStatusCode(), [200, 201]);
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    protected function handledResponse(ResponseInterface $response): array
    {
        if ($this->responseIsSuccessful($response)) {
            $result = XMLToArray::make($response->getBody());
            $data = $result['Cube']['Cube']['Cube'];
            return $this->responseFormat(true, $data);
        }
        return $this->responseFormat(false);
    }

    /**
     * @param bool $success
     * @param array $data
     * @return array
     */
    protected function responseFormat(bool $success, array $data = []): array
    {
        return [
            'success' => $success,
            'data' => $data
        ];
    }
}
