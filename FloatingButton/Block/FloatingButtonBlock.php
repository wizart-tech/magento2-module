<?php

declare(strict_types=1);

namespace Wizart\FloatingButton\Block;


use Magento\Framework\View\Element\Template;
use Wizart\FloatingButton\Helper\Config\HomePage\FloatingButton;
use Wizart\General\Helper\Config\GeneralConfig;

class FloatingButtonBlock extends Template
{
    /**
     * @var FloatingButton
     */
    private $floatingButtonConfig;

    /**
     * @var GeneralConfig
     */
    private $generalConfig;

    /**
     * @var array
     */
    private $dataAttributes;

    public function __construct(
        Template\Context $context,
        FloatingButton $floatingButtonConfig,
        GeneralConfig $generalConfig,
        $dataAttributes = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->floatingButtonConfig = $floatingButtonConfig;
        $this->generalConfig = $generalConfig;
        $this->dataAttributes = $dataAttributes;
    }

    public function getDataAttributes(): array
    {
        $attributes = [];
        foreach ($this->dataAttributes as $key => $dataKey) {
            if (!method_exists($this->floatingButtonConfig, $key)) {
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

    public function getHelper(): FloatingButton
    {
        return $this->floatingButtonConfig;
    }

    public function getToken(): string
    {
        return $this->generalConfig->getAPIToken();
    }
}
