<?php

declare(strict_types=1);

namespace Blockpc\App\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class CreatePackageCommand extends Command
{
    protected $packege;
    protected $name;

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
            $this->package = Str::ucfirst(Str::camel($packageName));
            $this->name = strtolower($this->package);

            $this->info('Creating Package: ' . $this->package);

            $paths = $this->getSourceFilePath();

            foreach ($paths as $key => $path) {
                $this->makeDirectory(dirname($path));

                $contents = $this->getSourceFile($key);
                $fullname = $this->getFullynamePackage($key);

                if (!$this->files->exists($path)) {
                    $this->files->put($path, $contents);
                    $this->info("File : {$fullname} created");
                } else {
                    $this->info("File : {$fullname} already exits");
                }
            }

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->error('Something went wrong!');

            if ( $path && $this->files->isDirectory(base_path('packages/'.$this->package)) ) {
                $this->info("Delete: packages/{$this->package}");
                $this->files->delete(base_path('packages/'.$this->package));
            }
        }
    }

    /**
     * Return the stub file path
     * @return array
     *
     */
    public function getStubPath() : array
    {
        return [
            'config' => base_path('Blockpc/stubs/config.stub'),
            'serviceprovider' => base_path('Blockpc/stubs/serviceprovider.stub')
        ];
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
    public function getStubVariables()
    {
        return [
            'PACKAGE'   => $this->package,
            'NAME'      => $this->name,
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile($key)
    {
        $stubs = $this->getStubPath();
        return $this->getStubContents($stubs[$key], $this->getStubVariables());
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
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    /**
     * Get the full path of generate class
     *
     * @return array
     */
    public function getSourceFilePath() : array
    {
        $base = "Packages\\{$this->package}\\App\\";
        return [
            'config' => base_path($base.'config\\config.php'),
            'serviceprovider' => base_path($base.'Providers\\'.$this->package.'ServiceProvider.php')
        ];
    }

    /**
     * Get the FQDN of package
     *
     * @return array
     */
    protected function getFullynamePackage($key)
    {
        $base = "Packages\\{$this->package}\\App\\";
        $names =  [
            'config' => $base.'config\\config.php',
            'serviceprovider' => $base.'Providers\\'.$this->package.'ServiceProvider.php'
        ];
        return $names[$key];
    }
}