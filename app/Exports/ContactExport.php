<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function collection()
    {
        return Contact::select("fname","lname","email","refId","phone","created_at","message")->get();
    }
     public function headings(): array
    {
        return ["First Name","Last Name","Email","Ref ID","Phone","Date","Message"];
    }
}
