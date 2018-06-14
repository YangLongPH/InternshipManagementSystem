<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
 	protected $primaryKey = 'id_role';

    public static function getTableName() {
        return with(new static)->getTable();
    }
}
