<?php

namespace App\Exports;

use App\Models\Salaries;
use Maatwebsite\Excel\Concerns\FromCollection;

class GajiExport implements FromCollection
{
    public function collection()
    {
        $query = Salaries::orderBy('created_at', 'desc')->get();
        $head = [
            "Pegawai",
            "Unit-Kerja",
            "Tanggal",
            "Gaji Pokok",
            "Uang Beras",
            "Uang Makan",
            "Lembur",
            "Tunjangan",
            "Hutang",
            "Deskripsi",
            "Total",
        ];
        $result = collect($query)->map(function($data) {
            return [
                "employee" => $data->employee->name,
                "unit_kerja" => $data->employee->unitKerja->title,
                "tanggal" => date('Y-m-d H:i:s', strtotime($data->bulan)),
                "gaji_pokok" => number_format($data->gaji_pokok),
                "uang_beras" => number_format($data->uang_beras),
                "uang_makan" => number_format($data->uang_makan),
                "lembur" => number_format($data->lembur),
                "tunjangan" => number_format($data->tunjangan),
                "hutang" => number_format($data->hutang),
                "description" => $data->description,
                "total" => number_format($data->total_income),
            ];
        });

        $ress = collect([$head, $result]);

        return $ress;
    }
}
