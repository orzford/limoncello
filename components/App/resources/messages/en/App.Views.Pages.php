<?php declare (strict_types=1);

use App\Web\Views;

return [
    Views::FORBIDDEN_PAGE => implode(DIRECTORY_SEPARATOR, ['errors', 'en', '403.html.twig']),
];
