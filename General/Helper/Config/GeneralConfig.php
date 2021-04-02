<?php

declare(strict_types=1);

namespace Wizart\General\Helper\Config;

class GeneralConfig extends AbstractConfig
{
    protected const GROUP = 'version';

    public function isModuleEnabled(): bool
    {
        return $this->isSetFlag('enabled') && $this->getConfigValue('token');
    }

    public function getAPIToken(): ?string
    {
        return $this->getConfigValue('token') ?: null;
    }
}