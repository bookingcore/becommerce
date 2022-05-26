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
    protected $email_type;

    const NEW_ORDER = 'new_order';
    const CANCELLED_ORDER = 'cancelled_order';
    const REFUNDED_ORDER = 'refunded_order';

    public function __construct($email_type = '',Order $order = null,$to = 'customer',$vendor = null)
    {
        $this->_order = $order;
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
            'order'=>$this->_order,
            'vendor'=>$this->vendor,
            'email_type'=>$this->email_type
        ];
        $subject = $this->getSubject();
        $view = 'order.emails.'.$this->email_type;
        switch ($this->email_type){
            case "new_order":
                $view = 'order.emails.'.$this->email_type;
                break;
            default:
                $view = 'order.emails.updated_order';
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
