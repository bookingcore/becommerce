<?php
namespace Modules\Booking\Models;

use App\BaseModel;
use Illuminate\Support\Facades\DB;
use Modules\Tour\Models\Tour;

class Payment extends BaseModel
{
    protected $table = 'product_order_payments';
}
