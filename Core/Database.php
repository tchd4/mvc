<?php
namespace App\Core;
use App\Core\Config\Config;
class Database {
    protected $_connection;

    protected $_query = [];
    protected $table;
    protected $method;
    protected $parameters = [] ;

    public function __construct()
    {
        $class = explode(DIRECTORY_SEPARATOR, strtolower(get_called_class())."s");
        $this->table = end( $class );
        $this->connection();
    }

    public function connection()
    {
        try {
            if(!$this->_connection){
                $this->_connection =  new \PDO('mysql:dbname='.Config::$dbname.';host='.Config::$host, Config::$dbuser, Config::$dbpass);
            }
            return $this->_connection;
        }catch (PDOException $e) {
            Echo "Error :". $e->getMessage();
        }
    }

    public function executeStatement()
    {
        if( in_array( $this->method, ['get', 'all']))
        {
            $query = $this->_connection->prepare(trim(implode(' ', $this->_query)));
            $query->execute();
        }else if(in_array( $this->method, ['insert', 'update', 'delete']) ) {
            $query = $this->_connection->prepare(trim(implode(' ', $this->_query)));
            $query->execute($this->parameters);
        }

        return $query;
    }
    public function get()
    {
        $this->method = "get";
        return $this->executeStatement()->fetch(\PDO::FETCH_OBJ);
    }

    public function insert($parameters = [])
    {
        $this->_query = [];
        $this->method = 'insert';
        $columns =  "`".implode('`, `', array_keys($parameters))."`";
        $params =  ":".implode(', :', array_keys($parameters));
        $this->parameters = $parameters;
        $this->_query[] = "INSERT INTO ".$this->table." (".$columns.") VALUES (".$params.")" ;
        $this->executeStatement();
    }

    public function update($parameters = [])
    {
        $this->_query = [];
        $this->method = 'update';
        $columns = '';
        foreach ($parameters as $pram => $value) {
            $columns .= '`'.$pram.'` = :'.$pram.', ';
        }
        $this->parameters = $parameters;
        $this->_query[] = "UPDATE ".$this->table." SET ".rtrim($columns, ", ") ;
        return $this;
    }

    public function delete()
    {
        $this->_query = [];
        $this->method = 'delete';
        $this->_query[] = "DELETE FROM ".$this->table;
        return $this;
    }

    public function where(array|object $prams)
    {
        $query = 'WHERE ';
        foreach ($prams as $pram => $value) {
            $query .= $pram.' = :'.$pram;
        }
        $this->parameters = array_merge($this->parameters, $prams);
        $this->_query[] = $query;
        $this->executeStatement();
    }



    public function all()
    {
        $this->method = 'all';
        return  $this->executeStatement()->fetchAll(\PDO::FETCH_OBJ);
    }

    public function select($filed = "*")
    {
        $this->_query = [];
        $this->_query[] = 'SELECT '.$filed.' FROM '.$this->table;
        return $this;
    }

}

