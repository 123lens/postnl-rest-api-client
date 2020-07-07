<?php
namespace Tests;

use Budgetlens\PostNLApi\RestApiClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase as BaseTestCase;
use GuzzleHttp\Handler\MockHandler;
use Tests\Client\HttpClient;

class TestCase extends BaseTestCase
{
    /**
     * Get Client
     * 
     * @param null $mockfile
     * @param int $mockHttp
     * @param array|string[] $mockHeaders
     * @return RestApiClient
     */
    public function getClient(
        $mockfile = null,
        int $mockHttp = 200,
        array $mockHeaders = ['Content-Type' => 'application/json']
    ) {
        if (!is_null($mockfile)) {
            return $this->initMockClient($mockfile, $mockHttp, $mockHeaders);
        } else {
            return $this->initClient();
        }
    }

    /**
     * Init Client (without mock response)
     * @return RestApiClient
     */
    private function initClient(): RestApiClient
    {
        // load client
        $client = new RestApiClient();
        $client->setHttpClient(new HttpClient(getenv('API_KEY')));
        return $client;
    }

    /**
     * Get Client with mock response
     * @param $mockfile
     * @param int|null $mockHttp
     * @param array|null $mockHeaders
     * @return RestApiClient
     */
    private function initMockClient(
        $mockfile,
        int $mockHttp,
        array $mockHeaders
    ): RestApiClient {
        // load client
        $client = new RestApiClient();

        $mockHandler = $this->createMockHandler($mockfile, $mockHttp, $mockHeaders);

        $client->setHttpClient(
            new HttpClient(
                getenv('API_KEY'),
                $mockHandler
            )
        );
        return $client;
    }

    /**
     * Create a mockhandler
     * @param null $mockFile
     * @param int $httpCode
     * @param string[] $headers
     * @return MockHandler
     */
    private function createMockHandler(
        $mockFile = null,
        $httpCode = 200,
        $headers = ['Content-Type' => 'application/json']
    ) {
        $mockContents = $this->getMockfile($mockFile);
        $mockHandler = new MockHandler();
        $mockHandler->append(new Response(
            $httpCode,
            $headers,
            $mockContents
        ));
        return $mockHandler;
    }

    /**
     * Get Mockfile
     * @param string $type
     * @return string|null
     */
    public function getMockfile(string $type): ?string
    {
        $file = __DIR__ . "/Mocks/{$type}";
        if (file_exists($file)) {
            return file_get_contents($file);
        }
        throw new \Exception("Mockfile not found '{$file}'");
    }



    /**
     * Set Mock Exception
     * @param string $type
     * @param int $httpCode
     * @throws \Exception
     */
    protected function setMockException(string $type, $httpCode = 400)
    {
        $response = new Response(400, [], $this->getMockfile($type));
        $msg = 'Error';
        $this->mockHandler->append(new BadResponseException(
            $msg,
            new Request('GET', 'test'),
            $response
        ));
    }
}
