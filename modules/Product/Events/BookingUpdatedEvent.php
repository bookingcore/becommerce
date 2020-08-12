<?php
namespace Modules\Product\Events;

use Modules\Product\Models\Product;
use Illuminate\Queue\SerializesModels;

class BookingUpdatedEvent
{
    use SerializesModels;
    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }
}