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

class ProductExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;


    protected $collection;

    public function __construct($collection){
        $this->collection = $collection;
    }

    public function collection()
    {
        return $this->collection->get();
    }

    public function map($product): array
    {
        $statusStock = $product->getStockStatus();

        return [
            $product->title,
            $product->categories->implode('name',','),
            $product->total_sold,
            format_money($product->net_sales),
            $statusStock['stock'],
            $product->remain_stock

        ];
    }

    public function headings(): array
    {
        return [
            __('Product title'),
            __('Category'),
            __('Items sold'),
            __('Net sales'),
            __('Status'),
            __('Stock'),
        ];
    }

}
