<?php

declare(strict_types=1);

namespace Wizart\FloatingButton\Helper\Config\HomePage;

use Wizart\General\Helper\Config\AbstractConfig;

class FloatingButton extends AbstractConfig
{
    protected const SECTION = 'wizart_floating_button';
    protected const GROUP = 'home_page';

    public function getConfigValueForButton(string $dataAttribute): ?string
    {
        try {
            $configValue = (string) $this->getConfigValue($dataAttribute);
        } catch (\Throwable $throwable) {
            return null;
        }

        return !empty($configValue) ? $configValue : null;
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

    public function getTooltipTitle(): ?string
    {
        return $this->getConfigValue('tooltip_title') ?: null;
    }

    public function getTooltipPosition(): ?string
    {
        return $this->getConfigValue('tooltip_position') ?: null;
    }

    public function isGlitterDisable(): bool
    {
        return $this->isSetFlag('glitter_disable');
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

    public function isCompact(): bool
    {
        return $this->isSetFlag('compact');
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