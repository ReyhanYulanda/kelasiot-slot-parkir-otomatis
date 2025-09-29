<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use Illuminate\Support\Facades\DB;

class MqttService
{
    protected $mqtt;

    public function __construct()
    {
        $server   = config('mqtt.host');
        $port     = config('mqtt.port');
        $clientId = config('mqtt.client_id');
        $username = config('mqtt.username');
        $password = config('mqtt.password');

        $settings = (new ConnectionSettings)
            ->setUsername($username)
            ->setPassword($password);

        $this->mqtt = new MqttClient($server, $port, $clientId);
        $this->mqtt->connect($settings, true);
    }

    public function subscribe()
    {
        $this->mqtt->subscribe('parkir/#', function (string $topic, string $message) {
            DB::table('parkir_logs')->insert([
                'topic' => $topic,
                'status' => $message,
                'created_at' => now(),
            ]);
            echo "Data diterima: $topic = $message\n";
        }, 0);

        $this->mqtt->loop(true);
    }

    public function publish($topic, $message)
    {
        $this->mqtt->publish($topic, $message);
    }
}
