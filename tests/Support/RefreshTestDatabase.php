<?php

declare(strict_types=1);

namespace Tests\Support;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Symfony\Component\Finder\Finder;

trait RefreshTestDatabase
{
    use DatabaseTransactions;

    protected function refreshTestDatabase(): void
    {
        if (! RefreshDatabaseState::$migrated) {
            $this->runMigrationsIfNecessary();

            $this->app[Kernel::class]->setArtisan(null);

            RefreshDatabaseState::$migrated = true;
        }

        $this->beginDatabaseTransaction();
    }

    protected function runMigrationsIfNecessary(): void
    {
        if (false === $this->identicalChecksum()) {
            $this->createChecksum();
            $this->artisan('migrate:fresh');
        }
    }

    protected function calculateChecksum(): string
    {
        $files = Finder::create()
            ->files()
            ->exclude([
                'factories',
                'seeders',
            ])
            ->in(database_path())
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
            ->getIterator();

        $files = array_keys(iterator_to_array($files));

        $checksum = collect($files)->map(fn($file) => md5_file($file))->implode('');

        return md5($checksum);
    }

    protected function checksumFilePath(): string
    {
        return base_path('.phpunit.database.checkum');
    }

    protected function createChecksum(): void
    {
        file_put_contents($this->checksumFilePath(), $this->calculateChecksum());
    }

    protected function checksumFileContents(): bool|string
    {
        return file_get_contents($this->checksumFilePath());
    }

    protected function isChecksumExists(): bool
    {
        return file_exists($this->checksumFilePath());
    }

    protected function identicalChecksum(): bool
    {
        if (false === $this->isChecksumExists()) {
            return false;
        }

        if ($this->checksumFileContents() === $this->calculateChecksum()) {
            return true;
        }

        return false;
    }
}