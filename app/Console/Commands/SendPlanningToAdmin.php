<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\Planning;
use Carbon\Carbon;
use App\ServiceRequest;
use Barryvdh\DomPDF\Facade as PDF;

class SendPlanningToAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'planning:send-to-admins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send planning to all admins';

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
        $admins = Admin::all();

        $serviceRequests = ServiceRequest::whereHas('timeSlot', function ($query) {
            $query->where('date', '>=', Carbon::now())
                ->where('date', '<=', Carbon::now()->add(7, 'day'));
        })->where('status', 1)
            ->get();

        if ($serviceRequests->count() !== 0) {
            foreach ($admins as $admin) {
                $user = $admin;
                $pdf = PDF::loadView('planning.export', compact('serviceRequests', 'user'));

                Mail::to($admin->email)->send(new Planning($pdf));
            }
        }


    }
}
