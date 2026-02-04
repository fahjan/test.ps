<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class MtcSMS
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toMtc($notifiable);
        $to = ltrim((string) phone($notifiable->mobile, config('services.countries')), '+');

        $key = config('services.mtc.key') ;
        $secret = config('services.mtc.secret');
        $from = config('services.mtc.from');

        if(isset($data['sender'])) {
            $key = $data['key'];
            $secret = $data['secret'];
            $from = $data['sender'];
        }
       

        $msg = str_replace(' ', '+', $data['message']);
        $url = "http://int.mtcsms.com/sendsms.aspx?username=" . $key. "&password=" . $secret . "&from=" . $from . "&to=$to&msg=$msg&type=0";
        
        return $this->getCurldata($url);
    }

    function getCurldata($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
