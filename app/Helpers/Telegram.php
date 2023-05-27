<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Telegram {
    const url = 'https://api.telegram.org/bot';
    const key = '6142371481:AAGLHpp9d3urYUvrLBDfUb4reiA8pIVQ-R0';
    
    public function sendMessage($message) {

        $client = new Client([
            'verify' => false,
        ]);
        
        try {
            $client->post(self::url . self::key . "/sendMessage", [
                'form_params' => [
                    'chat_id' => 576728247,
                    'text' => $message,
                    'parse_mode' => 'html',
                ],
            ]);
        
        } catch (RequestException $e) {
            // Error occurred
            // You can add your desired error handling logic here
            echo $e;
        }
    }

    public function sendDocument($filename)
    {
        try {
            $client = new Client([
                'verify' => false,
            ]);
    
            $response = $client->post("https://api.telegram.org/bot6142371481:AAGLHpp9d3urYUvrLBDfUb4reiA8pIVQ-R0/sendDocument", [
                'multipart' => [
                    [
                        'name' => 'chat_id',
                        'contents' => 576728247,
                    ],
                    [
                        'name' => 'caption',
                        'contents' => 'Here is the document.', // Add your desired message text here
                    ],
                    [
                        'name' => 'document',
                        'contents' => file_get_contents(storage_path('app/' . $filename)),
                        'filename' => $filename,
                    ],
                ],
            ]);
    
            if ($response->getStatusCode() === 200) {
                // Document sent successfully
                // You can add your desired logic here
                echo 'Document sent successfully!';
            } else {
                // Failed to send document
                // You can add your desired error handling logic here
                echo 'Failed to send document.';
            }
        } catch (RequestException $e) {
            // Error occurred
            // You can add your desired error handling logic here
            echo $e->getMessage();
        }
    }

    public function sendButtons2()
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
                        'inline_keyboard' => [
                            [['text' => 'Send message', 'callback_data' => 'button1']],
                            [['text' => 'Send doc', 'callback_data' => 'button2']],
                        ],
                    ],
                ],
            ]);

            dd($response);

        } catch (RequestException $e) {
            // Error occurred
            // You can add your desired error handling logic here
            echo $e->getMessage();
        }
    }
}


?>