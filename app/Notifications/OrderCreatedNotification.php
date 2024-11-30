<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $body = sprintf('تم شحن طلبك رقم %s   .', $this->order->number, );
        foreach($this->order->items as $item){
        $data [] =$item->product_name . ' : اسم المنتج' .  $item->quantity .' : كمية المنتج' .    $item->price  . ' : سعر المنتج' .    " >>>>" ;
        }
        $total = sprintf(' قيمة الفاتورة : %s ',$this->order->total,);

        $message =new MailMessage;
        $message->subject('تم استلام الطلب')
        ->line( $body)//عباره عن فقره بالرساله كل لاين فقرة
        ->line( $data )//عباره عن فقره بالرساله كل لاين فقرة
        ->line( $total )//عباره عن فقره بالرساله كل لاين فقرة
        ->line( 'في حال تم وصول الطلب اكد الوصول بالضغط على(تاكيد الوصول)')//عباره عن فقره بالرساله كل لاين فقرة
        ->action('تاكيد الوصول ', url('/delevorder'. '/' . $this->order->id));//rout('profile.session',$this->session->id)
            //->from('a@a.com','name')
            //->view('')مثل الفيو الي بالكنترولر
         return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

    }

    public function toDatabase($notifiable)
    {
        return ([
            'body'=>"new order(#{$this->order->number})",
            'url'=> url('/orders'),
            'order_id'=> $this->order->id,

        ]);
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'body'=>"new order(#{$this->order->number})",
            'url'=> url('/'),
            'order_id'=> $this->order->id,

        ]);
    }
}
