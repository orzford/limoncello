<?php declare (strict_types=1);

namespace Orzford\Limoncello\Azure\Contracts\Settings\Packages;

use Limoncello\Contracts\Settings\SettingsInterface;

/**
 * @package App
 */
interface AzureSettingsInterface extends SettingsInterface
{
    /**
     * Config key
     */
    const KEY_CLIENT_NAME = 0;

    /**
     * Config key
     */
    const KEY_CLIENT_ID = self::KEY_CLIENT_NAME + 1;

    /**
     * Config key
     */
    const KEY_TENANT_ID = self::KEY_CLIENT_ID + 1;

    /**
     * Config key
     */
    const KEY_CLIENT_SECRET = self::KEY_TENANT_ID + 1;

    /**
     * Config key
     */
    const KEY_REDIRECT_URIS = self::KEY_CLIENT_SECRET + 1;
}
