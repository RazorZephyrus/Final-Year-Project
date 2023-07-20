<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Salaries;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class GajiImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return Salaries|null
     */
    public function collection(Collection $row)
    {
        $data = collect($row)->map(function($arr, $i) {
            if($i != 0) {
                $excelDate = $arr[1];
                $miliseconds = ($excelDate - (25567 + 2)) * 86400 * 1000;
                $seconds = $miliseconds / 1000;
                $employee = Employee::where('name', $arr[0])->firstOrFail();
                $total = ($arr[2] + $arr[3] + $arr[4] + $arr[5] + $arr[6]) - $arr[7];
                return [
                    'employee_id' => $employee->id,
                    'gaji_pokok' => $arr[2],
                    'uang_beras' => $arr[3],
                    'uang_makan' => $arr[4],
                    'lembur' => $arr[5],
                    'tunjangan' => $arr[6],
                    'hutang' => $arr[7],
                    'descriptions' => $arr[8],
                    'bulan' => date("Y-m-d", $seconds),
                    'total_income' => $total,
                ];
            }
        });

        if(count($data) > 0) {
            foreach ($data as $key => $value) {
                if ($value != null) {
                    Salaries::create($value);
                }
            }
        }
    }
}