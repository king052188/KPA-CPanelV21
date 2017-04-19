<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class MySQLDatabase extends \Eloquent {
    protected $table = 'mysql_database_table';
}
