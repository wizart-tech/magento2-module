<?php

declare(strict_types=1);

namespace Wizart\FloatingButton\Helper\Config\HomePage;

use Wizart\General\Helper\Config\AbstractConfig;

class FloatingButton extends AbstractConfig
{
    const SECTION = 'wizart_floating_button';
    const GROUP = 'home_page';

    public function isCompact(): bool
    {
        return $this->isSetFlag('compact');
    }

    public function getCompact(): string
    {
        return $this->isSetFlag('compact') ? 'true': 'false';
    }
}