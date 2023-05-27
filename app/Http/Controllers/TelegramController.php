<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function sendMessage() {

        $telegram = new Telegram();
        $telegram->sendMessage("Hello");
    }



public function sendDocument()
{
    $telegram = new Telegram();
    $telegram->sendDocument("circuits.png");
}

public function sendButtons()
{
    try {
        $client = new Client([
            'verify' => false,
        ]);

        $response = $client->post("https://api.telegram.org/bot6142371481:AAGLHpp9d3urYUvrLBDfUb4reiA8pIVQ-R0/sendMessage", [
            'json' => [
                'chat_id' => 576728247,
                'text' => 'Please select an option:',
                'reply_markup' => [
                    'keyboard' => [
                        [['text' => 'Button 1']],
                        [['text' => 'Button 2']],
                    ],
                    'one_time_keyboard' => true,
                    'resize_keyboard' => true,
                ],
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            // Message sent successfully
            // You can add your desired logic here
            echo 'Message sent successfully!';
        } else {
            // Failed to send message
            // You can add your desired error handling logic here
            echo 'Failed to send message.';
        }
    } catch (RequestException $e) {
        // Error occurred
        // You can add your desired error handling logic here
        echo $e->getMessage();
    }
}

    public function sendButtons2()
    {
        $telegram = new Telegram();
        $telegram->sendButtons2();
    }

    public function handleCallbackQuery(Request $request)
    {
        Log::error('aaaa.');
        Log::debug($request->all());
        $this->sendMessage();
        $update = json_decode($request->getContent(), true);
        
        if (isset($update['callback_query'])) {
            $callbackQuery = $update['callback_query'];
            $callbackData = $callbackQuery['data'];

            if ($callbackData === 'button1') {
                // Handle Button 1 click by sending a message
                $this->sendMessage();
            } elseif ($callbackData === 'button2') {
                // Handle Button 2 click by sending a document
                $this->sendDocument();
            }
        }
    }


    public function getinfo() {
        $client = new Client([
            'verify' => false,
        ]);
        
        try {
            $response = $client->get("https://api.telegram.org/bot6142371481:AAGLHpp9d3urYUvrLBDfUb4reiA8pIVQ-R0/getMe");
        
            if ($response->getStatusCode() === 200) {
                // Message sent successfully
                // You can add your desired logic here
                dd($response);
            } else {
                // Failed to send message
                // You can add your desired error handling logic here
                echo 'Failed to send message.';
            }
        } catch (RequestException $e) {
            // Error occurred
            // You can add your desired error handling logic here
            echo $e;
        }
    }

    public function setwebhook() {
        $client = new Client([
            'verify' => false,
        ]);
        
        try {
            $response = $client->get("https://api.telegram.org/bot6142371481:AAGLHpp9d3urYUvrLBDfUb4reiA8pIVQ-R0/setWebhook?url=https://127.0.0.1:8000/webhook");
        
            if ($response->getStatusCode() === 200) {
                // Message sent successfully
                // You can add your desired logic here
                dd($response);
            } else {
                // Failed to send message
                // You can add your desired error handling logic here
                echo 'Failed to send message.';
            }
        } catch (RequestException $e) {
            // Error occurred
            // You can add your desired error handling logic here
            echo $e;
        }
    }

    public function getwebhook() {
        $client = new Client([
            'verify' => false,
        ]);
        
        try {
            $response = $client->get("https://api.telegram.org/bot6142371481:AAGLHpp9d3urYUvrLBDfUb4reiA8pIVQ-R0/getWebhookInfo");
        
            if ($response->getStatusCode() === 200) {
                // Message sent successfully
                // You can add your desired logic here
                dd($response);
            } else {
                // Failed to send message
                // You can add your desired error handling logic here
                echo 'Failed to send message.';
            }
        } catch (RequestException $e) {
            // Error occurred
            // You can add your desired error handling logic here
            echo $e;
        }
    }
}
