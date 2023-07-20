<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\PaidLeave;
use Maatwebsite\Excel\Concerns\FromCollection;

class CutiExport implements FromCollection
{
    public function collection()
    {
        $query = PaidLeave::orderBy('created_at', 'desc')->get();
        $head = [
            "Pegawai",
            "Unit-kerja",
            "Jenis Cuti",
            "Approve By",
            "Notes",
            "Status",
            "Approve Tanggal",
            "Deskripsi",
            "Start Cuti",
            "End Cuti",
            "CreatedAt",
        ];
        $result = collect($query)->map(function($data) {
            return [
                $data->employee->name,
                $data->employee->unitKerja->title,
                $data->type->title,
                $data->approveBy->name,
                $data->approve_notes,
                $data->approve_status == 1 ? 'Approve' : ($data->approve_status == 2 ? 'Tolak' : '-'),
                date('Y-m-d H:i:s', strtotime($data->approve_at)),
                $data->description,
                date('Y-m-d', strtotime($data->start_date)),
                date('Y-m-d', strtotime($data->end_date)),
                date('Y-m-d H:i:s', strtotime($data->created_at))
            ];
        });

        $ress = collect([$head, $result]);

        return $ress;
    }
}
