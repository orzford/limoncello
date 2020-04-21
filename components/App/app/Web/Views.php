<?php declare (strict_types=1);

namespace App\Web;

/**
 * @package App
 */
interface Views
{
    /**
     * Namespace name for mapping template IDs with localized templates.
     *
     * see `server/resources/messages/{LANG}/App.Views.Pages.php`
     */
    const NAMESPACE = 'App.Views.Pages';

    /**
     *
     */
    const NOT_FORBIDDEN_PAGE = 0;

    /**
     *
     */
    const NOT_FOUND_PAGE = self::NOT_FORBIDDEN_PAGE + 1;
}
