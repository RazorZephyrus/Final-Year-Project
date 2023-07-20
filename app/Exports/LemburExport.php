<?php

namespace App\Exports;

use App\Models\OverTime;
use Maatwebsite\Excel\Concerns\FromCollection;

class LemburExport implements FromCollection
{
    public function collection()
    {
        $query = OverTime::orderBy('created_at', 'desc')->get();
        $head = [
            "Pegawai",
            "Unit-kerja",
            "Approve By",
            "Notes",
            "Status",
            "Approve Tanggal",
            "Deskripsi",
            "Progress",
            "Start Cuti",
            "End Cuti",
            "Fee",
            "CreatedAt",
        ];
        $result = collect($query)->map(function($data) {
            return [
                $data->employee->name,
                $data->employee->unitKerja->title,
                $data->approveBy->name,
                $data->approve_notes,
                $data->approve_status == 1 ? 'Approve' : ($data->approve_status == 2 ? 'Tolak' : '-'),
                date('Y-m-d H:i:s', strtotime($data->approve_at)),
                $data->description,
                $data->progress ?? '-',
                date('Y-m-d H:i', strtotime($data->start_date.' '.$data->start_time)),
                date('Y-m-d H:i', strtotime($data->end_date.' '.$data->end_time)),
                $data->fee,
                date('Y-m-d H:i:s', strtotime($data->created_at))
            ];
        });

        $ress = collect([$head, $result]);

        return $ress;
    }
}
