<?php declare (strict_types=1);

use App\Web\Views;

return [
    Views::NOT_FORBIDDEN_PAGE => implode(DIRECTORY_SEPARATOR, ['pages', 'en', '403.html.twig']),
    Views::NOT_FOUND_PAGE     => implode(DIRECTORY_SEPARATOR, ['pages', 'en', '404.html.twig']),

    //    Views::EMBER_APP_PAGE        => implode(DIRECTORY_SEPARATOR, ['pages', 'en', 'ember-app.html.twig']),
    //    Views::NOT_UNAUTHORIZED_PAGE => implode(DIRECTORY_SEPARATOR, ['pages', 'en', '401.html.twig']),
];
