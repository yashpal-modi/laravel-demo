<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class blogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogs:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To remove last 30 days blog from blog table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Cleaning posts table...');
        $date = Carbon::now()->subDays(30);
        $users = Post::where('created_at', '>=', $date)->delete();
        $this->info('All done!');
    }
}
