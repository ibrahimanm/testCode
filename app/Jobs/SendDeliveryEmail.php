<?php

namespace App\Jobs;

use App\Mail\DeliveryOrderInvoice;
use App\Models\Client;
use App\Models\PackageOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendDeliveryEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $order;

    public function __construct(PackageOrder $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client=Client::find($this->order->client_id);

       // Mail::to($client->email)
        Mail::to($client->email)
            ->send(new DeliveryOrderInvoice($this->order));
    }
}
