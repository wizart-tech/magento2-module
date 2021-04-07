<?php

declare(strict_types=1);

namespace Wizart\PIMConnector\Helper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Psr\Log\LoggerInterface;
use Wizart\General\Helper\Config\GeneralConfig;
use Wizart\PIMConnector\Helper\Config\Configuration;

class Connector extends AbstractHelper
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var Configuration
     */
    private $config;

    /**
     * @var GeneralConfig
     */
    private $generalConfig;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        Context $context,
        Configuration $config,
        GeneralConfig  $generalConfig,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->config = $config;
        $this->httpClient = new Client([
            'base_uri' => $this->config->getEndpointUrl(),
            'allow_redirects' => false,
        ]);
        $this->generalConfig = $generalConfig;
        $this->logger = $logger;
    }

    public function isProductAvailable(string $productSku): bool
    {
        try {
            $response = $this->httpClient->get($this->config->getAvailableSkuUri(), [
                'headers' => [
                    'accept' => 'application/json',
                ],
                'query' => [
                    'vendor_code' => $productSku,
                    'api_token' => $this->generalConfig->getAPIToken(),
                ],
            ]);

            $payload = json_decode((string)$response->getBody(), true);

            return $payload['data']['vendor_codes'][$productSku] ?? false;
        } catch (BadResponseException $badResponseException) {
            $this->logger->critical(
                sprintf('Exception during product validation. Product sku: %s. %s', $productSku, $badResponseException->getMessage()),
                $badResponseException->getTrace()
            );

            return false;
        }
    }
}