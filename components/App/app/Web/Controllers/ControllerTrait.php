<?php declare (strict_types=1);

namespace App\Web\Controllers;

use App\Routes\WebRoutes;
use App\Web\Views;
use Limoncello\Contracts\Application\ApplicationConfigurationInterface as A;
use Limoncello\Contracts\Application\CacheSettingsProviderInterface;
use Limoncello\Contracts\Http\RequestStorageInterface;
use Limoncello\Contracts\L10n\FormatterFactoryInterface;
use Limoncello\Contracts\L10n\FormatterInterface;
use Limoncello\Contracts\Routing\RouterInterface;
use Limoncello\Contracts\Settings\SettingsProviderInterface;
use Limoncello\Contracts\Templates\TemplatesInterface;
use Limoncello\Flute\Contracts\Http\WebControllerInterface;
use Limoncello\Flute\Http\Traits\DefaultControllerMethodsTrait;
use Limoncello\Flute\Http\Traits\FluteRoutesTrait;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @package App
 */
trait ControllerTrait
{
    use DefaultControllerMethodsTrait {
        defaultCreateApi as createApi;
        defaultCreateQueryParser as createQueryParser;
        defaultCreateParameterMapper as createParameterMapper;

        defaultCreate as private defaultCreateJsonApi;
        defaultUpdate as private defaultUpdateJsonApi;
    }

    use FluteRoutesTrait {
        apiController as private;
        webController as private;
        relationship as private;
    }

    /**
     * @param ContainerInterface $container
     * @param int                $viewId
     * @param array              $parameters
     * @param string             $viewsNamespace
     *
     * @return string
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected static function view(
        ContainerInterface $container,
        int $viewId,
        array $parameters = [],
        string $viewsNamespace = Views::NAMESPACE
    ): string
    {
        $formatter = static::createFormatter($container, $viewsNamespace);
        $templateName = $formatter->formatMessage((string)$viewId);

        /** @var TemplatesInterface $templates */
        $templates = $container->get(TemplatesInterface::class);

        /** @var CacheSettingsProviderInterface $provider */
        $provider = $container->get(CacheSettingsProviderInterface::class);
        $originUri = $provider->getApplicationConfiguration()[A::KEY_APP_ORIGIN_URI];

        $body = $templates->render($templateName, $parameters);

        return $body;
    }

    /**
     * @param ContainerInterface $container
     * @param string             $namespace
     * @param string|null        $locale
     *
     * @return FormatterInterface
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected static function createFormatter(
        ContainerInterface $container,
        string $namespace,
        string $locale = null
    ): FormatterInterface
    {
        /** @var FormatterFactoryInterface $factory */
        $factory = $container->get(FormatterFactoryInterface::class);
        $formatter = $locale === null ?
            $factory->createFormatter($namespace) : $factory->createFormatterForLocale($namespace, $locale);

        return $formatter;
    }

    /**
     * @param ContainerInterface $container
     * @param string             $settingsClass
     *
     * @return array
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected static function getSettings(ContainerInterface $container, string $settingsClass): array
    {
        /** @var SettingsProviderInterface $provider */
        $provider = $container->get(SettingsProviderInterface::class);
        $settings = $provider->get($settingsClass);

        return $settings;
    }

    /**
     * @param ContainerInterface $container
     * @param string             $type
     * @param string             $method
     * @param string|null        $index
     * @param string             $routePrefix
     *
     * @return string
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected static function createUrl(
        ContainerInterface $container,
        string $type,
        string $method,
        string $index = null,
        string $routePrefix = WebRoutes::WEB_URI_PREFIX
    ): string
    {
        $routeName = static::routeName($routePrefix, $type, $method);
        $result = $index === null ?
            static::createRouteUrl($container, $routeName) :
            static::createRouteUrl($container, $routeName, [WebControllerInterface::ROUTE_KEY_INDEX => $index]);

        return $result;
    }

    /**
     * @param ContainerInterface $container
     * @param string             $routeName
     * @param array              $placeholders
     * @param array              $queryParams
     *
     * @return string
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected static function createRouteUrl(
        ContainerInterface $container,
        string $routeName,
        array $placeholders = [],
        array $queryParams = []
    ): string
    {
        /** @var RouterInterface $router */
        $router = $container->get(RouterInterface::class);

        $hostUri = static::getHostUri($container);
        $url = $router->get($hostUri, $routeName, $placeholders, $queryParams);

        return $url;
    }

    /**
     * @param ContainerInterface $container
     *
     * @return string
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected static function getHostUri(ContainerInterface $container): string
    {
        /** @var RequestStorageInterface $curRequestStorage */
        $curRequestStorage = $container->get(RequestStorageInterface::class);
        $curRequestUri = $curRequestStorage->get()->getUri();

        $scheme = $curRequestUri->getScheme();
        $host = $curRequestUri->getHost();
        $port = $curRequestUri->getPort();

        $result = $port === null || $port === 80 ? "$scheme://$host" : "$scheme://$host:$port";

        return $result;
    }
}
