<?php
namespace Modules\Product\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Product\Models\Order;
use Modules\Product\Models\Product;

class StatusUpdatedEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $booking;
    public $oldStatus;
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
            case "vendor":
                $subject = __('[:site_name] The order status has been updated',['site_name'=>setting_item('site_title')]);
                break;

            case "customer":
                $subject = __('Your order status has been updated',['site_name'=>setting_item('site_title')]);
                break;

        }

        return $this->subject($subject)->view('Booking::emails.status-updated-booking')->with([
            'booking'   => $this->booking,
            'service'   => $this->booking->service,
            'to'=>$this->email_type
        ]);
    }
}
