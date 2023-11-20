<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Entities\Config;

use Dondake\MusicTransposition\Exceptions\Config\ConfigurationException;

class ConfigInstance
{
    private array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../../../config/settings.php';
    }

    /**
     * @throws ConfigurationException
     */
    public function get(string $path): mixed
    {
        $item = $this->config;

        foreach (explode('.', $path) as $pathItem) {
            $item = $item[$pathItem] ?? null;

            if ($item === null) {
                throw new ConfigurationException($path . ' - No values specified for configuration parameters');
            }
        }

        return $item;
    }
}