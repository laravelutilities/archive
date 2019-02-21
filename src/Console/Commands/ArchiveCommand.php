<?php

namespace LaravelUtility\Archive\Console\Commands;

use \Illuminate\{
    Console\Command,
    Support\Facades\Artisan
};

class ArchiveCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archive:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will start archiving table data.';

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
        
        $connect = \DB::connection('archive')->getPdo();
        foreach ($tables as $table) {
            preg_match('/([a-z\_]*)\.*([a-z\_]*)/', $table, $regs);
            $newTable = empty($regs[2]) ? $regs[1] : $regs[2];
            $connect->query("INSERT IGNORE INTO ". config('archive.connections.archive.database')
                    . ".$newTable (SELECT * FROM $table WHERE DATE(FROM_UNIXTIME(".config('archive.created_at_field')
                    ."))<= DATE_SUB(CURDATE(), INTERVAL " . config('archive.keep')."))");
            
            \DB::statement("DELETE FROM $table WHERE DATE(FROM_UNIXTIME(".config('archive.created_at_field')
                    ."))<= DATE_SUB(CURDATE(), INTERVAL " . config('archive.keep').")");
            
        }
    }

}
