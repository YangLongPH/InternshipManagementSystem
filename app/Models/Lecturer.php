<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $table = 'lecturers';
 	protected $primaryKey = 'id_lecturer';

    public static function getTableName() {
        return with(new static)->getTable();
    }
}
