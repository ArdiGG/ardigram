<?php

namespace App\Services;

use Illuminate\Support\Facades\Date;

class DateCheckService{
    public function isValid(string $strDate,string $strFormat="d/m/Y")
    {
        $date = Date::createFromFormat($strFormat,$strDate);

        dd($date);
    }
}
