<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    protected $table = 'interns';
 	protected $primaryKey = 'id_intern';

    public static function getTableName() {
        return with(new static)->getTable();
    }
}
