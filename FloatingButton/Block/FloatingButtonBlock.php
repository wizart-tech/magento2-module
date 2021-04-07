<?php

declare(strict_types=1);

namespace Wizart\FloatingButton\Block;


use Magento\Framework\View\Element\Template;
use Wizart\FloatingButton\Helper\Config\HomePage\FloatingButton;
use Wizart\General\Block\AbstractButtonsTemplate;
use Wizart\General\Helper\Config\GeneralConfig;

class FloatingButtonBlock extends AbstractButtonsTemplate
{
    public function __construct(
        Template\Context $context,
        FloatingButton $floatingButtonConfig,
        GeneralConfig $generalConfig,
        $dataAttributes = [],
        array $data = []
    ) {
        parent::__construct($context, $floatingButtonConfig, $generalConfig, $dataAttributes, $data);
    }
}
