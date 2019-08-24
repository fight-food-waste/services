<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Planning;
use Carbon\Carbon;
use App\ServiceRequest;
use Barryvdh\DomPDF\Facade as PDF;
use App\Volunteer;

class SendPlanningToAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'planning:send-to-volunteers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send planning to all volunteers';

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
        $volunteers = Volunteer::all();

        $serviceRequests = ServiceRequest::whereHas('timeSlot', function ($query) {
            $query->where('date', '>=', Carbon::now())
                ->where('date', '<=', Carbon::now()->add(7, 'day'));
        })->where('status', 1)
            ->get();

        foreach ($volunteers as $volunteer) {

            $serviceRequests = $serviceRequests->where('volunteer_id', $volunteer->id);

            if ($serviceRequests->count() !== 0) {
                $user = $volunteer;
                $pdf = PDF::loadView('planning.export', compact('serviceRequests', 'user'));

                Mail::to($volunteer->email)->send(new Planning($pdf));
            }
        }
    }
}
