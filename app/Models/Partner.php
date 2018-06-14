<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
 	protected $primaryKey = 'id_partner';

    public static function getTableName() {
        return with(new static)->getTable();
    }
}
