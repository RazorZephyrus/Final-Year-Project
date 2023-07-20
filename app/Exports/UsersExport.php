<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function collection()
    {
        $query = User::orderBy('created_at', 'desc')->get();
        $head = [
            "Pegawai",
            "email-login",
            "Unit-kerja",
            "nip",
            "phone",
            "Username",
            "roles",
            "CreatedAt",
        ];
        $result = collect($query)->map(function($data) {
            return [
                $data->employee->name ?? '-',
                $data->email,
                $data->employee->unitKerja->title ?? '-',
                $data->employee->nip ?? '-',
                $data->employee->phone ?? '-',
                $data->username,
                $data->roles[0]->name ?? 'N/A',
                date('Y-m-d H:i:s', strtotime($data->created_at))
            ];
        });

        $ress = collect([$head, $result]);

        return $ress;
    }
}
