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

    public function __construct(
        Template\Context $context,
        FloatingButton $floatingButtonConfig,
        GeneralConfig $generalConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->floatingButtonConfig = $floatingButtonConfig;
        $this->generalConfig = $generalConfig;
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
