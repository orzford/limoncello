<?php declare (strict_types=1);

namespace Orzford\Limoncello\Azure\Packages;

use Limoncello\Contracts\Commands\ContainerConfiguratorInterface;
use Limoncello\Contracts\Container\ContainerInterface;
use Limoncello\Contracts\Settings\SettingsProviderInterface;
use Psr\Container\ContainerInterface as PsrContainerInterface;
use TheNetworg\OAuth2\Client\Provider\Azure as AzureConnection;

/**
 * @package App
 */
class AzureContainerConfigurator implements ContainerConfiguratorInterface
{
    /**
     *
     */
    const CONFIGURATOR = [self::class, self::CONTAINER_METHOD_NAME];

    /**
     * @inheritDoc
     */
    public static function configureContainer(ContainerInterface $container): void
    {
        $container[AzureConnection::class] = function (PsrContainerInterface $container): AzureConnection {
            $settings = $container->get(SettingsProviderInterface::class)->get(AzureSettings::class);

            $azureConnection = new AzureConnection([
                'clientId'     => $settings[AzureSettings::KEY_CLIENT_ID],
                'clientSecret' => $settings[AzureSettings::KEY_CLIENT_SECRET],
                'redirectUri'  => $settings[AzureSettings::KEY_REDIRECT_URI],
            ]);

            return $azureConnection;
        };
    }
}
