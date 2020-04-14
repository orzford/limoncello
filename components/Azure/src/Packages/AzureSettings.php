<?php declare (strict_types=1);

namespace Orzford\Limoncello\Azure\Packages;

use Limoncello\Common\Reflection\CheckCallableTrait;
use Limoncello\Contracts\Settings\SettingsInterface;

/**
 * @package App
 */
class AzureSettings implements SettingsInterface
{
    use CheckCallableTrait;

    /**
     * @var array
     */
    private $appConfig;

    /**
     * @inheritDoc
     */
    public function get(array $appConfig): array
    {
        $this->appConfig = $appConfig;

        $defaults = $this->getSettings();
    }

    protected function getSettings()
    {
        $appConfig = $this->getAppConfig();

        return [
            static::KEY_CLIENT_NAME                          => (bool)($appConfig[A::KEY_IS_LOG_ENABLED] ?? false),
            static::KEY_CODE_EXPIRATION_TIME_IN_SECONDS      => 10 * 60,
            static::KEY_TOKEN_EXPIRATION_TIME_IN_SECONDS     => 60 * 60,
            static::KEY_RENEW_REFRESH_VALUE_ON_TOKEN_REFRESH => true,
        ];
    }

    /**
     * @return array
     */
    public function getAppConfig(): array
    {
        return $this->appConfig;
    }
}
