<?php

namespace App\Exports;

use App\Models\Attendence;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiExport implements FromCollection
{
    public function collection()
    {
        $query = Attendence::orderBy('created_at', 'desc')->get();
        $head = [
            "Pegawai",
            "Unit-Kerja",
            "Status",
            "Tanggal-Absen"
        ];
        $result = collect($query)->map(function($data) {
            return [
                "employee" => $data->employee->name,
                "unit_kerja" => $data->employee->unitKerja->title,
                "status" => $data->status == 1 ? "IN" : ($data->status == 2 ? "OUT" : "Lembur"),
                "tanggal" => date('Y-m-d H:i:s', strtotime($data->absence_date))
            ];
        });

        $ress = collect([$head, $result]);

        return $ress;
    }
}
