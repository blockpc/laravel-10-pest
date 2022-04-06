<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Profile;
use App\Models\User;
use Blockpc\App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Blockpc\App\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\Support\CreatePermission;
use Tests\Support\CreateRole;
use Tests\Support\CreateUser;

abstract class TestBase extends TestCase
{
    use RefreshDatabase;

    use CreateRole, CreatePermission, CreateUser;
    
    protected function setUp():void
    {
        parent::setUp();
        $this->app->make(PermissionRegistrar::class)->registerPermissions();
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
            $this->setUpUser();
        }

        if (isset($uses[AuthenticationAdmin::class])) {
            $this->setUpUser();
        }

        if (isset($uses[AuthenticationUser::class])) {
            $this->setUpUser();
        }
    }
}