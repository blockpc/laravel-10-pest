<?php

declare(strict_types=1);

namespace Blockpc\App\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class CreatePackageCommand extends Command
{
    protected $package;
    protected $name;
    protected $camel_name;
    protected $plural_name;
    protected $snake_name;
    protected $date;

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blockpc:package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the basic structure for a new package';

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $packageName = $this->ask('Package name');
            $this->camel_name = Str::camel($packageName);
            $this->plural_name = Str::plural($this->camel_name);
            $this->snake_name = Str::snake($this->plural_name);
            $this->package = Str::ucfirst($this->camel_name);
            $this->name = strtolower($this->package);
            $this->date = Carbon::now()->format('Y_m_d_Hmi');

            $this->info('Creating Package: ' . $this->package);

            $paths = $this->getSourceFilePath();

            foreach ($paths as $key => $path) {
                $this->makeDirectory(dirname(base_path($path)));

                $contents = $this->getSourceFile($key);

                if (!$this->files->exists($path)) {
                    $file = Str::padRight(Str::ucfirst($key), 18);
                    $this->files->put($path, $contents);
                    $this->info("{$file} : {$paths[$key]} created");
                } else {
                    $this->info("{$file} : {$paths[$key]} already exits");
                }
            }

            Artisan::call('optimize', ['--quiet' => true]);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->error('Something went wrong!');

            if ( $this->files->isDirectory(base_path('packages/'.$this->package)) ) {
                if ( $this->files->deleteDirectory(base_path('packages/'.$this->package)) ) {
                    $this->info("Delete: packages/{$this->package}");
                } else {
                    $this->info("Something went wrong at delete: packages/{$this->package}");
                }
            }
        }
    }

    /**
     * Return the stub file path
     * 
     * @return string
     */
    public function getStubPath($key) : string
    {
        $stubs = [
            'controller'      => base_path('Blockpc/stubs/controller.stub'),
            'view'            => base_path('Blockpc/stubs/view.stub'),
            'route'           => base_path('Blockpc/stubs/route.stub'),
            'migration'       => base_path('Blockpc/stubs/migration.stub'),
            'lang'            => base_path('Blockpc/stubs/lang.stub'),
            'model'           => base_path('Blockpc/stubs/model.stub'),
            'serviceprovider' => base_path('Blockpc/stubs/serviceprovider.stub'),
            'config'          => base_path('Blockpc/stubs/config.stub'),
        ];
        return $stubs[$key];
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     */
    public function getStubVariables() : array
    {
        return [
            'PACKAGE'   => $this->package,
            'NAME'      => $this->name,
            'TABLE'     => $this->snake_name,
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     */
    public function getSourceFile($key)
    {
        return $this->getStubContents($this->getStubPath($key), $this->getStubVariables());
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub , $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('$'.$search.'$' , $replace, $contents);
        }

        return $contents;
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * 
     * @return bool
     */
    protected function makeDirectory($path) : bool
    {
        if (!$this->files->isDirectory($path)) {
            return $this->files->makeDirectory($path, 0777, true, true);
        }
        return false;
    }

    /**
     * Get the full path of generate class
     *
     * @return array
     */
    public function getSourceFilePath() : array
    {
        $base = "Packages\\{$this->package}";
        return [
            'controller'      => "{$base}\\App\\Http\\Controllers\\{$this->package}Controller.php",
            'view'            => "{$base}\\resources\\views\\index.blade.php",
            'route'           => "{$base}\\routes\\web.php",
            'migration'       => "{$base}\\database\\migrations\\{$this->date}_create_{$this->snake_name}_table.php",
            'lang'            => "{$base}\\lang\\en\\{$this->name}.php",
            'model'           => "{$base}\\App\\Models\\{$this->package}.php",
            'serviceprovider' => "{$base}\\App\\Providers\\{$this->package}ServiceProvider.php",
            'config'          => "{$base}\\config\\config.php",
        ];
    }
}