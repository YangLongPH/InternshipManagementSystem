<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $table = 'dialogs';
 	protected $primaryKey = 'id_dialog';

    public static function getTableName() {
        return with(new static)->getTable();
    }
}
