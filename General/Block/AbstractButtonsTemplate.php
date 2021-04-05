<?php

declare(strict_types=1);

namespace Wizart\General\Block;

use Magento\Framework\View\Element\Template;
use Wizart\General\Helper\Config\AbstractConfig as ButtonConfig;
use Wizart\General\Helper\Config\GeneralConfig;

abstract class AbstractButtonsTemplate extends Template
{
    /**
     * @var ButtonConfig
     */
    protected $buttonConfig;

    /**
     * @var GeneralConfig
     */
    protected $generalConfig;

    /**
     * @var array
     */
    protected $dataAttributes;

    public function __construct(
        Template\Context $context,
        ButtonConfig $buttonConfig,
        GeneralConfig $generalConfig,
        $dataAttributes = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->buttonConfig = $buttonConfig;
        $this->generalConfig = $generalConfig;
        $this->dataAttributes = $dataAttributes;
    }

    public function getDataAttributes(): array
    {
        $attributes = [];
        foreach ($this->dataAttributes as $key => $dataKey) {
            if (!method_exists($this->buttonConfig, $key)) {
                continue;
            }

            $value = $this->getHelper()->$key();
            if (null === $value) {
                continue;
            }
            $attributes[$dataKey] = $value;
        }

        return $attributes;
    }

    public function isEnabled(): bool
    {
        return $this->isModuleEnabled() && $this->isButtonEnabled();
    }

    public function isModuleEnabled(): bool
    {
        return $this->generalConfig->isModuleEnabled();
    }

    public function isButtonEnabled(): bool
    {
        return $this->getHelper()->isButtonEnabled();
    }

    public function getHelper(): ButtonConfig
    {
        return $this->buttonConfig;
    }

    public function getToken(): string
    {
        return $this->generalConfig->getAPIToken();
    }
}