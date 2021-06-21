<?php

declare(strict_types=1);

namespace Wizart\General\Helper\Config;


use Magento\Framework\App\Helper\AbstractHelper;

abstract class AbstractConfig extends AbstractHelper
{
    const SECTION = 'wizart_general';
    const GROUP = '';

    protected function getPath(string $field, string $group = null, string $section = null): string
    {
        return sprintf('%s/%s/%s', $section ?? static::SECTION, $group ?? static::GROUP, $field);
    }

    /**
     * @param $configPath
     * @return string|array|null
     */
    public function getConfigValue(string $field)
    {
        return $this->scopeConfig->getValue($this->getPath($field));
    }

    public function isSetFlag(string $field): bool
    {
        return $this->scopeConfig->isSetFlag($this->getPath($field));
    }

    public function getSrc(): string
    {
        return $this->getConfigValue('src');
    }

    public function isButtonEnabled(): bool
    {
        return $this->isSetFlag('enabled');
    }

    public function getTitle()
    {
        return $this->getConfigValue('title') ?: null;
    }

    public function getBackground()
    {
        return $this->getConfigValue('background') ?: null;
    }

    public function getColor()
    {
        return $this->getConfigValue('color') ?: null;
    }

    public function isTooltipDisabled(): bool
    {
        return $this->isSetFlag('tooltip_disable');
    }

    public function getTooltipDisable(): string
    {
        return $this->isSetFlag('tooltip_disable') ? 'true' : 'false';
    }

    public function getTooltipTitle()
    {
        return $this->getConfigValue('tooltip_title') ?: null;
    }

    public function getTooltipPosition()
    {
        return $this->getConfigValue('tooltip_position') ?: null;
    }

    public function isGlitterDisabled(): bool
    {
        return $this->isSetFlag('glitter_disable');
    }

    public function getGlitterDisable(): string
    {
        return $this->isSetFlag('glitter_disable') ? 'true' : 'false';
    }

    public function getWidth()
    {
        return $this->getConfigValue('width') ?: null;
    }

    public function getHeight()
    {
        return $this->getConfigValue('height') ?: null;
    }

    public function get()
    {
        return $this->getConfigValue('') ?: null;
    }

    public function getBorder()
    {
        return $this->getConfigValue('border') ?: null;
    }

    public function getBorderRadius()
    {
        return $this->getConfigValue('border_radius') ?: null;
    }

    public function getImage()
    {
        return $this->getConfigValue('image') ?: null;
    }

    public function getClassName()
    {
        return $this->getConfigValue('class_name') ?: null;
    }

    public function getOnloadCallback()
    {
        return $this->getConfigValue('onload_callback') ?: null;
    }

    public function getOnCloseCallback()
    {
        return $this->getConfigValue('on_close_callback') ?: null;
    }

    public function getElementSelector()
    {
        return $this->getConfigValue('element_selector') ?: null;
    }

    public function getInsertElementPosition()
    {
        return $this->getConfigValue('insert_element_position') ?: null;
    }

    public function getIframeElementSelector()
    {
        return $this->getConfigValue('iframe_element_selector') ?: null;
    }

    public function getInsertIframeElementPosition()
    {
        return $this->getConfigValue('insert_iframe_element_position') ?: null;
    }
}
