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
        return $this->scopeConfig->getValue($this->getPath($field));
    }

    public function isSetFlag(string $field): bool
    {
        return $this->scopeConfig->isSetFlag($this->getPath($field));
    }
}
