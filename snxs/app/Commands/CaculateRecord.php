<?php

namespace snxs\Commands;

use snxs\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class CaculateRecord extends Command implements SelfHandling
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        echo "test";
        //
    }
}
