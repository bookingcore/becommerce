<?php


namespace Modules\Order\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Order\Emails\OrderEmail;
use Modules\Order\Models\Order;
use function Symfony\Component\Mime\to;

class NewOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Order
     */
    protected $_order;

    protected $_to;

    public function __construct(Order $order,$to = 'customer')
    {
        $this->_order = $order;
        $this->_to = $to;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return Mailable
     */
    public function toMail($notifiable)
    {
        $address = $notifiable instanceof AnonymousNotifiable
            ? $notifiable->routeNotificationFor('mail')
            : $notifiable->email;

        return (new OrderEmail(OrderEmail::NEW_ORDER,$this->_order,$this->_to))->to($address);
    }
}
