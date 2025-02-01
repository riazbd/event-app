<?php

namespace App\Imports;

use App\Models\EventReminder;
use Maatwebsite\Excel\Concerns\ToModel;

class EventRemindersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EventReminder([
            'title' => $row[0],
            'description' => $row[1],
            'event_time' => $row[2],
            'location' => $row[3],
            'attendees' => $row[4],
        ]);
    }
}
