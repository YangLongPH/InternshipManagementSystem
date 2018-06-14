<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $table = 'internships';
 	protected $primaryKey = 'id_internship';

    public static function getTableName() {
        return with(new static)->getTable();
    }
}
