<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Response;
use Auth;
use Input;
use Mail;
use App\User;
use Illuminate\Support\Facades\Artisan;

class Commands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $exitCode = Artisan::call('view:clear');
        $exitCode2 = Artisan::call('key:generate');
        $exitCode3 = Artisan::call('cache:clear');

        $Token = 'PfXLjN3sHsErMXmTBIeyyzHYkDfrO5gGvY9paKcxIdI';

        $str = "เริ่มจับเวลา";

        $message =  $str;
        $lineapi = $Token; // ใส่ token key ที่ได้มา
        $mms =  trim($message); // ข้อความที่ต้องการส่ง
        date_default_timezone_set("Asia/Bangkok");
        $chOne = curl_init();
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        // SSL USE
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
        //POST
        curl_setopt( $chOne, CURLOPT_POST, 1);

        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms");

        curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);

        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);

        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $chOne );

    }
}
