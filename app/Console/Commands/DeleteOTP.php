<?php

namespace App\Console\Commands;

use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOTP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes expired OTPs from the database.';

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
        $now = Carbon::now();
        Otp::where('expiration_time', '<', $now)->delete();
        $this->info('Expired OTPs have been deleted.');
    }
}
