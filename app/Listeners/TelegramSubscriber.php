<?php 


namespace App\Listeners;

class TelegramSubscriber {
    public function subscribe($events) {
        $events->listen();
    }
}

?>