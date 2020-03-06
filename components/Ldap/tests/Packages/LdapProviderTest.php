<?php declare (strict_types=1);

namespace Orzford\Limoncello\Tests\Ldap\Packages;

use Orzford\Limoncello\Ldap\Packages\LdapProvider;
use Orzford\Limoncello\Test\Ldap\TestCase;

/**
 * @package App
 */
class LdapProviderTest extends TestCase
{
    /**
     * Test provider.
     */
    public function testProvider()
    {
        $this->assertNotEmpty(LdapProvider::getContainerConfigurators());
    }
}
