<?php

declare(strict_types=1);

namespace Wizart\EntryPointButton\Block\CatalogPage;

use Magento\Framework\View\Element\Template;
use Wizart\EntryPointButton\Helper\Config\CatalogPage\EntryPointButton;
use Wizart\General\Block\AbstractButtonsTemplate;
use Wizart\General\Helper\Config\GeneralConfig;
use Wizart\PIMConnector\Helper\Config\Configuration;

class Iframe extends AbstractButtonsTemplate
{
    /**
     * @var Configuration
     */
    private $connectorConfig;

    public function __construct(
        Template\Context $context,
        EntryPointButton $buttonConfig,
        GeneralConfig $generalConfig,
        Configuration $connectorConfig,
        $dataAttributes = [],
        array $data = []
    ) {
        parent::__construct($context, $buttonConfig, $generalConfig, $dataAttributes, $data);
        $this->connectorConfig = $connectorConfig;
    }

    public function getContext(): string
    {
        return $this->generalConfig->getContext() ?? '';
    }

    public function getPimUrl(): string
    {
        return $this->connectorConfig->getEndpointUrl();
    }
}
