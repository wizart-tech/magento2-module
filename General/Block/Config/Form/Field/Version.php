<?php

declare(strict_types = 1);

namespace Wizart\General\Block\Config\Form\Field;

use \Magento\Config\Block\System\Config\Form\Field;
use \Magento\Framework\Data\Form\Element\AbstractElement;

class Version extends Field
{
    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        return "<span style='position:relative;top:4px;'>" . WIZART_VERSION . "</span>";
    }
}
