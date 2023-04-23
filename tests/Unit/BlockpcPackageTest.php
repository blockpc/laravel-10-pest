<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestBase;

class BlockpcPackageTest extends TestBase
{
    use RefreshDatabase;

    protected $package;
    protected $snake_name;
    protected $name;
    protected $date;
    protected $filesystem;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->package = 'Something';
        $this->name = 'something';
        $this->snake_name = 'somethings';
        $date = Carbon::create(2001, 5, 21, 12); // create testing date
        Carbon::setTestNow($date); // set the mock
        $this->date = $date->format('Y_m_d_Hmi');
        $this->filesystem = new Filesystem;
    }

    /** @test */
    public function can_run_comand_test()
    {
        $this->filesystem->deleteDirectory('Packages/' . $this->package);

        $this->artisan('blockpc:package')
            ->expectsQuestion('Package name', $this->name)
            ->expectsOutput('Creating Package: ' . $this->package)
            ->assertExitCode(0);

        $files = $this->getSourceFilePath();

        foreach ($files as $key => $file) {
            $this->assertTrue($this->filesystem->exists(base_path($file)));
        }

        $this->filesystem->deleteDirectory('Packages/' . $this->package);
        $this->assertTrue(!$this->filesystem->isDirectory(base_path('Packages/'. $this->package)));

        Artisan::call('optimize');
    }

    /**
     * Get the full path of generate class
     *
     * @return array
     */
    private function getSourceFilePath() : array
    {
        $base = "Packages/{$this->package}";
        return [
            'controller'      => "{$base}/App/Http/Controllers/{$this->package}Controller.php",
            'view'            => "{$base}/resources/views/index.blade.php",
            'route'           => "{$base}/routes/web.php",
            'migration'       => "{$base}/database/migrations/{$this->date}_create_{$this->snake_name}_table.php",
            'lang'            => "{$base}/lang/en/{$this->name}.php",
            'model'           => "{$base}/App/Models/{$this->package}.php",
            'serviceprovider' => "{$base}/App/Providers/{$this->package}ServiceProvider.php",
            'config'          => "{$base}/config/config.php",
            'factory'         => "{$base}/database/factories/{$this->package}Factory.php",
            'test'            => "{$base}/tests/Route{$this->package}Test.php",
        ];
    }
}
