<?php

namespace LaravelUtility\Archive\Console\Commands;

use Illuminate\Console\Command;

class ArchiveSetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archive:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tables = config('archive.tables');
        
        if(empty($tables))
        {
            $this->error('Please add the table in archive configuration');
        }

        config(['database.connections.archive' => config('archive.connections.archive')]);

        \DB::statement("CREATE DATABASE IF NOT EXISTS " . config('archive.connections.archive.database')
                . " CHARACTER SET " . config('archive.connections.archive.charset')
                . " COLLATE " . config('archive.connections.archive.collation') . ";");
        $connect = \DB::connection('archive')->getPdo();

        foreach ($tables as $table) {
            preg_match('/([a-z\_]*)\.*([a-z\_]*)/', $table, $regs);
            $newTable = empty($regs[2]) ? $regs[1] : $regs[2];
            $connect->query("CREATE TABLE IF NOT EXISTS " . config('archive.connections.archive.database') . ".$newTable LIKE $table");
        }

    }
}
