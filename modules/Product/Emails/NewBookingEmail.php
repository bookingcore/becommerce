<?php
namespace Modules\Product\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Product\Models\Order;
use Modules\Product\Models\Product;

class NewBookingEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $booking;
    protected $email_type;

    public function __construct(Order $booking,$to = 'admin')
    {
        $this->booking = $booking;
        $this->email_type = $to;
    }

    public function build()
    {

        $subject = '';
        switch ($this->email_type){
            case "admin":
                $subject = __('[:site_name] New order has been made',['site_name'=>setting_item('site_title')]);
            break;

            case "vendor":
                $subject = __('[:site_name] Your service got new booking',['site_name'=>setting_item('site_title')]);

            break;

            case "customer":
                $subject = __('Thank you for your order',['site_name'=>setting_item('site_title')]);
            break;

        }
        return $this->subject($subject)->view('Booking::emails.new-booking')->with([
            'booking' => $this->booking,
            'service' => $this->booking->service,
            'to'=>$this->email_type
        ]);
    }
}
