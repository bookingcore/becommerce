<?php
namespace Modules\Report\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class RevenueExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;


    protected $collection;
    protected $request;

    public function __construct($collection,$request){
        $this->collection = $collection;
        $this->request = $request;
    }

    public function collection()
    {
        return $this->collection;
    }

    public function map($row): array
    {
        $time = $this->request->ranger=='year'?'Month':"Date";
        return [
            $time,
            $row->orders??0,
            $row->items_sold??0,
            format_money($row->net_sales??0),
            format_money($row->gross_sales??0),
            format_money($row->tax_amount??0),
            format_money($row->shipping_amount??0),
            format_money($row->discount_amount??0),
        ];
    }

    public function headings(): array
    {
        $time = $this->request->ranger=='year'?'Month':"Date";

        return [
            __($time),
            __('Orders'),
            __('Items sold'),
            __('Gross sales'),
            __('Net sales'),
            __('Taxes'),
            __('Shipping'),
            __('Coupons'),
        ];
    }

}
