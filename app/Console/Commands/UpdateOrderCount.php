<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateOrderCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update order count';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderCount = DB::table('order_master')->count();
        file_put_contents(storage_path('app/order_count.txt'), $orderCount);
        $this->info('Order count updated: ' . $orderCount);
    }
}
