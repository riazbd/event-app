<?php

namespace App\Exports;

use App\Models\EventReminder;
use Maatwebsite\Excel\Concerns\FromCollection;

class EventRemindersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EventReminder::all();
    }
}
