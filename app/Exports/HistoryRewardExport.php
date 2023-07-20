<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\RewardHistory;
use Maatwebsite\Excel\Concerns\FromCollection;

class HistoryRewardExport implements FromCollection
{
    public function collection()
    {
        $query = RewardHistory::orderBy('created_at', 'desc')->get();
        $head = [
            "Pegawai",
            "Unit-kerja",
            "Claim",
            "Point Sebelum",
            "Point Sesudah Claim",
            "CreatedAt",
        ];
        $result = collect($query)->map(function($data) {
            return [
                "employee" => $data->employee->name,
                "unit_kerja" => $data->employee->unitKerja->title,
                "reward" => $data->reward->title,
                "rsb" => $data->point_before,
                "rss" => $data->point_after,
                "created_at" => date('Y-m-d H:i:s', strtotime($data->created_at))
            ];
        });

        $ress = collect([$head, $result]);

        return $ress;
    }
}
