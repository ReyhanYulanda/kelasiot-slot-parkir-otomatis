<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MqttService;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe ke MQTT broker dan simpan data ke DB';

    public function handle(MqttService $mqtt)
    {
        $this->info("Mulai subscribe ke MQTT...");
        $mqtt->subscribe();
    }
}
