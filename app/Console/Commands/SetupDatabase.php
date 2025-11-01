<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use PDOException;

class SetupDatabase extends Command
{
    protected $signature = 'db:setup';
    protected $description = 'create db if not exists, run migrations and seeder';

    public function handle()
    {

        $databaseName = config('database.connections.mysql.database');
        $charset = config('database.connections.mysql.charset', 'utf8mb4');
        $collation = config('database.connections.mysql.collation', 'utf8mb4_unicode_ci');
        $this->info("Setting up database: {$databaseName}");

        try {
            DB::connection()->getPdo();
            $this->info("Database '{$databaseName}' already exists.");
        } catch (PDOException $e) {
            $this->warn("Database '{$databaseName}' not found. Creating it...");

            try {
                $originalConfig = config('database.connections.mysql');

                Config::set('database.connections.mysql.database', null);
                DB::purge('mysql');

                DB::statement("CREATE DATABASE IF NOT EXISTS `{$databaseName}` CHARACTER SET {$charset} COLLATE {$collation}");
                $this->info("Database '{$databaseName}' created successfully.");

                Config::set('database.connections.mysql', $originalConfig);
                DB::purge('mysql');
            } catch (PDOException $e) {
                $this->info("Failed to create database: " . $e->getMessage());
                return 1;
            }
        }

        $this->info("Running migrations...");
        try {
            Artisan::call('migrate', ['--force' => true]);
            $this->info("Migrations completed successfully");
        } catch (\Exception $e) {
            $this->error("Migration failed: " . $e->getMessage());
            return 1;
        }

        $this->info("Running seeders...");
        try {
            Artisan::call('db:seed', ['--force' => true]);
            $this->info("Seeders completed successfully");
        } catch (\Exception $e) {
            $this->error("Seeding failed: " . $e->getMessage());
            return 1;
        }

        $this->info("Database setup completed successfully!");

        return 0;
    }
}
