<?php

declare(strict_types=1);

namespace Tests;

use Spatie\Permission\PermissionRegistrar;
use Tests\Support\CreatePermission;
use Tests\Support\CreateRole;
use Tests\Support\CreateUser;

abstract class TestBase extends TestCase
{
    use CreateRole, CreatePermission, CreateUser;

    protected function setUp():void
    {
        parent::setUp();
        $this->app->make(PermissionRegistrar::class)->registerPermissions();

        $this->new_permission('super admin');
    }
    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        if (isset($uses[AuthenticationSudo::class])) {
            $this->setUpSudo();
        }

        if (isset($uses[AuthenticationAdmin::class])) {
            $this->setUpAdmin();
        }

        if (isset($uses[AuthenticationUser::class])) {
            $this->setUpUser();
        }

        return $uses;
    }
}
