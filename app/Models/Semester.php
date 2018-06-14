<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semesters';
 	protected $primaryKey = 'id_semesterw';

    public static function getTableName() {
        return with(new static)->getTable();
    }
}
