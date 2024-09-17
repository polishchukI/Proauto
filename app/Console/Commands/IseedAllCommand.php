<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class iSeedAllCommand extends Command
{
    const IGNORED_TABLES = [
        "migrations",
    ];
    
    protected $signature = 'iseed:all';
    
    protected $description = 'Run iseed to generate all database tables except migrations';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $query = \DB::select("SHOW TABLES");
        $collectionArray = collect($query)->toArray();
        $dbPrefix = \DB::getTablePrefix();
        $tables = "";
        $iteration = 0;

        foreach ($collectionArray as $item) {
            $tablesName = array_values((array) $item)[0];

            if ($iteration <= (count($collectionArray) - 2)) {
                $tablesName .= ",";
            }

            $tables .= str_replace($dbPrefix, '', $tablesName);
            $iteration++;
        }

        $this->info('Calling iseed for all tables except migrations ...');
        $this->call('iseed', [
            "tables" => $tables,
            "--noindex" => true,
            "--force" => true,
        ]);
    }
}