<?php declare (strict_types=1);

namespace Orzford\Limoncello\Azure\Packages;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException as AzureIdentityProviderException;
use Limoncello\Contracts\Settings\SettingsProviderInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TheNetworg\OAuth2\Client\Provider\Azure as AzureConnection;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\Response\TextResponse;

/**
 * @package App
 */
class AzureController
{
    /**
     * @var callable
     */
    const TOKEN_HANDLER = [self::class, 'token'];

    /**
     * @param array                  $routeParams
     * @param ContainerInterface     $container
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     * @throws AzureIdentityProviderException
     */
    public static function token(
        array $routeParams,
        ContainerInterface $container,
        ServerRequestInterface $request
    ): ResponseInterface
    {
        /** @var AzureConnection $azureConnection */
        $azureConnection = $container->get(AzureConnection::class);

        if (!isset($request->getQueryParams()['code'])) {
            $authUrl = $azureConnection->getAuthorizationUrl();

            return new RedirectResponse($authUrl);
        } else {
            $settings = $container->get(SettingsProviderInterface::class)->get(AzureSettings::class);

            $token = $azureConnection->getAccessToken('authorization_code', [
                'code'     => $request->getQueryParams()['code'],
                'resource' => $settings[AzureSettings::KEY_GRAPH_RESOURCE_ENDPOINT],
            ]);

            $currentUser = $azureConnection->get('me', $token);

            return new TextResponse($currentUser);
        }
    }
}
