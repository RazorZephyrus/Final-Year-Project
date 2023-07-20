<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class PegawaiExport implements FromCollection
{
    public function collection()
    {
        $query = Employee::orderBy('created_at', 'desc')->get();
        $head = [
            "Pegawai",
            "Unit-kerja",
            "NIP",
            "Alias",
            "Gender",
            "Phone",
            "Tempat-lahir",
            "Tanggal-lahir",
            "Point",
            "Fee-lembur",
            "CreatedAt",
        ];
        $result = collect($query)->map(function($data) {
            return [
                "employee" => $data->name,
                "unit_kerja" => $data->unitKerja->title,
                "nip" => $data->nip,
                "alias" => $data->alias,
                "gender" => $data->gender,
                "phone" => $data->phone,
                "tempat" => $data->tempat,
                "dob" => $data->dob,
                "point" => $data->point,
                "fee_lembur" => $data->fee_lembur,
                "created_at" => date('Y-m-d H:i:s', strtotime($data->created_at))
            ];
        });

        $ress = collect([$head, $result]);

        return $ress;
    }
}
