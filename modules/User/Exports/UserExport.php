<?php
namespace Modules\User\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function collection()
    {
        return User::select([
            'business_name',
            'first_name',
            'last_name',
            'email',
            'phone',
            'status',
        ])->get();
    }

    public function map($user): array
    {
        return [
            ltrim($user->business_name,"=-"),
            ltrim($user->first_name,"=-"),
            ltrim($user->last_name,"=-"),
            ltrim($user->email,"=-"),
            ltrim($user->phone,"=-"),
            ltrim($user->status,"=-"),
        ];
    }

    public function headings(): array
    {
        return [
            __('Business Name'),
            __('First name'),
            __('Last name'),
            __('Email'),
            __('Phone'),
            __('Status'),
        ];
    }
}
