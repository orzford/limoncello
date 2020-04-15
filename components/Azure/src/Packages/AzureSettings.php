<?php declare (strict_types=1);

namespace Orzford\Limoncello\Azure\Packages;

use Limoncello\Common\Reflection\CheckCallableTrait;
use Orzford\Limoncello\Azure\Contracts\Settings\Packages\AzureSettingsInterface;

/**
 * @package App
 */
class AzureSettings implements AzureSettingsInterface
{
    use CheckCallableTrait;

    /**
     * @var array
     */
    private $appConfig;

    /**
     * @inheritDoc
     */
    final public function get(array $appConfig): array
    {
        $this->appConfig = $appConfig;

        $defaults = $this->getSettings();

        $clientName = $defaults[static::KEY_CLIENT_NAME];
        assert(empty($clientName) === false, "Invalid Client Name `$clientName`.");

        $clientId = $defaults[static::KEY_CLIENT_ID];
        assert(empty($clientId) === false, "Invalid Client Id `$clientId`.");

        $tenantId = $defaults[static::KEY_TENANT_ID];
        assert(empty($tenantId) === false, "Invalid Tenant Id `$tenantId`.");

        $clientSecret = $defaults[static::KEY_CLIENT_SECRET];
        assert(empty($clientSecret) === false, "Invalid Client Name `$clientSecret`.");

        $redirectUris = $defaults[static::KEY_REDIRECT_URIS];
        assert(empty($redirectUris) === false, "Invalid Redirect Uris `$redirectUris`.");

        return $defaults + [
                static::KEY_CLIENT_NAME   => $clientName,
                static::KEY_CLIENT_ID     => $clientId,
                static::KEY_TENANT_ID     => $tenantId,
                static::KEY_CLIENT_SECRET => $clientSecret,
                static::KEY_REDIRECT_URIS => $redirectUris,
            ];
    }

    protected function getSettings(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAppConfig(): array
    {
        return $this->appConfig;
    }
}
