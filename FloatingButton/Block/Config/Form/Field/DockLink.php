<?php

declare(strict_types = 1);

namespace Wizart\FloatingButton\Block\Config\Form\Field;

use \Magento\Config\Block\System\Config\Form\Field;
use \Magento\Framework\Data\Form\Element\AbstractElement;

class DockLink extends Field
{
    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        return "<a target='_blank' href='https://wizart.atlassian.net/wiki/spaces/WDP/pages/474349624/Floating+button'>Floating button documentation.</link>";
    }
}
