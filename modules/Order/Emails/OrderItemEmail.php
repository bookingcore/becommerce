<?php


namespace Modules\Order\Emails;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;

class OrderItemEmail extends \Illuminate\Mail\Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var OrderItem|null
     */
    protected $_order_item;
    protected $email_to;
    protected $vendor;
    protected $email_type;

    const CANCELLED_ORDER = 'cancelled_order';
    const REFUNDED_ORDER = 'refunded_order';

    public function __construct($email_type = '',OrderItem $order = null,$to = 'customer',$vendor = null)
    {
        $this->_order_item = $order;
        $this->email_to = $to;
        $this->vendor = $vendor;
        $this->email_type = $email_type;
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
            'orderItem'=>$this->_order_item,
            'vendor'=>$this->vendor,
            'email_type'=>$this->email_type,
            'order'=>$this->_order_item->order
        ];
        $subject = $this->getSubject();
        switch ($this->email_type){
            default:
                $view = 'order.emails.order-item.updated_order';
                break;
        }
        return $this->subject($subject)->view($view,$data);
    }

    public function getSubject(){
        switch ($this->email_to){
            case "admin":
                return setting_item_with_lang('email_a_'.$this->email_type.'_subject');
                break;
            case "vendor":
                return setting_item_with_lang('email_v_'.$this->email_type.'_subject');
                break;
            case "customer":
            default:
                return setting_item_with_lang('email_c_'.$this->email_type.'_subject');
                break;
        }
    }
}
