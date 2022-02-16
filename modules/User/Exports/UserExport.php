<?php
namespace Modules\User\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class UserExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;

    protected $role_id = false;

    public function __construct($role_id = false){
        $this->role_id = $role_id;
    }

    public function collection()
    {
        $user = User::query()->select([
            'business_name',
            'first_name',
            'last_name',
            'email',
            'phone',
            'email_verified_at',
            'status',
        ]);
        if($this->role_id){
            $user->where('role_id', $this->role_id);
        }
        return $user->get();
    }

    public function map($user): array
    {
        return [
            ltrim($user->business_name,"=-"),
            ltrim($user->first_name,"=-"),
            ltrim($user->last_name,"=-"),
            ltrim($user->email,"=-"),
            ltrim($user->phone,"=-"),
            $user->hasVerifiedEmail() ? '1' : '0',
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
            __('Email Verified?'),
            __('Status'),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => '@'
        ];
    }
}
