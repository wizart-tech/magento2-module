<?php

declare(strict_types=1);

namespace Wizart\EntryPointButton\Block\ProductPage;


use Magento\Framework\View\Element\Template;
use Wizart\EntryPointButton\Helper\Config\ProductPage\EntryPointButton;
use Wizart\General\Block\AbstractButtonsTemplate;
use Wizart\General\Helper\Config\GeneralConfig;

class EntryPointButtonBlock extends AbstractButtonsTemplate
{

    public function __construct(
        Template\Context $context,
        EntryPointButton $buttonConfig,
        GeneralConfig $generalConfig,
        $dataAttributes = [],
        array $data = []
    ) {
        parent::__construct($context, $buttonConfig, $generalConfig, $dataAttributes, $data);
    }
}
