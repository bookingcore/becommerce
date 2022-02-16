<?php


namespace Modules\Order\Emails;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Order\Models\Order;

class OrderEmail extends \Illuminate\Mail\Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $_order;
    protected $email_to;
    protected $vendor;

    public function __construct(Order $order,$to = 'customer',$vendor = null)
    {
        $this->_order = $order;
        $this->email_to = $to;
        $this->vendor = $vendor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'email_to'=>$this->email_to,
            'row'=>$this->_order,
        ];
        $subject = $this->getSubject();

        return $this->subject($subject)->view('Order::emails.order',$data);
    }

    public function getSubject(){
        switch ($this->email_to){
            case "admin":
                return setting_item_with_lang('email_a_new_order_subject');
                break;
            case "vendor":
                return setting_item_with_lang('email_v_new_order_subject');
                break;
            case "customer":
            default:
                return setting_item_with_lang('email_c_new_order_subject');
                break;
        }
    }
}
