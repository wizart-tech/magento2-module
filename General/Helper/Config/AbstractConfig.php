<?php

declare(strict_types=1);

namespace Wizart\General\Helper\Config;


use Magento\Framework\App\Helper\AbstractHelper;

abstract class AbstractConfig extends AbstractHelper
{
    protected const SECTION = 'wizart_general';
    protected const GROUP = '';

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
        return $this->scopeConfig->getValue($this->getPath($field), \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function isSetFlag(string $field): bool
    {
        return $this->scopeConfig->isSetFlag($this->getPath($field), \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getSrc(): string
    {
        return $this->getConfigValue('src');
    }

    public function isButtonEnabled(): bool
    {
        return $this->isSetFlag('enabled');
    }

    public function getTitle(): ?string
    {
        return $this->getConfigValue('title') ?: null;
    }

    public function getBackground(): ?string
    {
        return $this->getConfigValue('background') ?: null;
    }

    public function getColor(): ?string
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

    public function getTooltipTitle(): ?string
    {
        return $this->getConfigValue('tooltip_title') ?: null;
    }

    public function getTooltipPosition(): ?string
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

    public function getWidth(): ?string
    {
        return $this->getConfigValue('width') ?: null;
    }

    public function getHeight(): ?string
    {
        return $this->getConfigValue('height') ?: null;
    }

    public function get(): ?string
    {
        return $this->getConfigValue('') ?: null;
    }

    public function getBorder(): ?string
    {
        return $this->getConfigValue('border') ?: null;
    }

    public function getBorderRadius(): ?string
    {
        return $this->getConfigValue('border_radius') ?: null;
    }

    public function getImage(): ?string
    {
        return $this->getConfigValue('image') ?: null;
    }

    public function getClassName(): ?string
    {
        return $this->getConfigValue('class_name') ?: null;
    }

    public function getOnloadCallback(): ?string
    {
        return $this->getConfigValue('onload_callback') ?: null;
    }

    public function getOnCloseCallback(): ?string
    {
        return $this->getConfigValue('on_close_callback') ?: null;
    }

    public function getElementSelector(): ?string
    {
        return $this->getConfigValue('element_selector') ?: null;
    }

    public function getInsertElementPosition(): ?string
    {
        return $this->getConfigValue('insert_element_position') ?: null;
    }

    public function getIframeElementSelector(): ?string
    {
        return $this->getConfigValue('iframe_element_selector') ?: null;
    }

    public function getInsertIframeElementPosition(): ?string
    {
        return $this->getConfigValue('insert_iframe_element_position') ?: null;
    }
}
