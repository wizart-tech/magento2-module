<?php

declare(strict_types = 1);

define('WIZART_VERSION', '2.4.2');

use Magento\Framework\Component\ComponentRegistrar as Registrar;

Registrar::register(Registrar::MODULE, "Wizart_General", __DIR__);
