<?php

declare(strict_types = 1);

define('WIZART_VERSION', '2.2.3');

use Magento\Framework\Component\ComponentRegistrar as Registrar;

Registrar::register(Registrar::MODULE, "Wizart_General", __DIR__);