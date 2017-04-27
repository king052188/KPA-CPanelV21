<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class MySQLSharedDatabase extends \Eloquent {
    protected $table = 'mysql_database_shared_table';
}
