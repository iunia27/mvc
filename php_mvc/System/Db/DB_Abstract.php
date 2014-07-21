<?php

abstract class DB_Abstract {

    protected $_connection = null;
    protected $config = null;

    /**
     * The class constructor
     * @param type $config
     */
    public function __construct($config) {
        $this->config = $config;
    }

    protected function _checkRequiredOptions(array $config) {
        // we need at least a dbname
           if (!array_key_exists('host', $config)) {
            throw new Exception("Configuration array must have a key for 'host' for login credentials");
        }
        
        if (!array_key_exists('dbname', $config)) {
            throw new Exception("Configuration array must have a key for 'dbname' that names the database instance");
        }

        if (!array_key_exists('password', $config)) {
            throw new Exception("Configuration array must have a key for 'password' for login credentials");
        }

        if (!array_key_exists('username', $config)) {
            throw new Exception("Configuration array must have a key for 'username' for login credentials");
        }
    }

    public function getConnection() {
        $this->_connect();
        return $this->_connection;
    }


    public function insert($table, array $array_values) {
        $sql = null;
        $keys = array_keys($array_values);
        $values = array_values($array_values);

        if ($keys !== range(0, count($array_values) - 1)) {  //if the array is associative
            $sql = "INSERT INTO " . $table . "(" . implode(",", $keys) . ") " . "VALUES('" . implode("','", $values) . "')";
        } else {
            $sql = "INSERT INTO " . $table . " VALUES('" . implode("','", $values) . "')";
        }
        return $sql;
    }

    public function update($table, array $array_values, $where = '', $whereOp = '') {
        $sql = null;
        $keys = array_keys($array_values);
        if ($keys !== range(0, count($array_values) - 1)) {  //if the array is associative
            $set = '';
            foreach ($array_values as $key => $value) {
                $set = $key . "='" . $value . "'";
            }
            $sql = "UPDATE " . $table . " SET " . $set;
            $whereString = '';
            if (is_array($where)) {       // if where is an array
                $whereString = _where($where, $whereOp);
                $sql .= ' WHERE ' . $whereString; // add the where clause
            } elseif ($where != '') {
                throw new Exception("Update must receive an associative array for the where clause");
            }
        } else {
            throw new Exception("Update must receive an associative array for setting the values");
        }
        return $sql;
    }

    public function delete($table, $where = '', $whereOp = '') {
        $sql = "DELETE FROM " . $table;
        $whereString = '';
        if (is_array($where)) {       // if where is an array
            $whereString = _where($where, $whereOp);
            $sql .=' WHERE ' . $whereString;  // add the where clause
        } elseif ($where != '') {
            throw new Exception("Update must receive an associative array for the where clause");
        }
        return $sql;
    }

    public function select($what, $table, $where = '', $whereOp = '', $groupBy = '', $orderBy = '', $orderByType = 'DESC') { //simple select
        $sql = "SELECT ";

        if (is_array($what)) {    // if what is an array
            $values = array_values($what);
            $sql .= implode("','", $values);
        } elseif ($what === '*') {
            $sql .= $what;
        } else {
            throw new Exception("Select must receive an array or '*' for the column names.");
        }
        $sql .= ' FROM ' . $table;
        if (is_array($where)) {       // if where is an array
            $whereString = _where($where, $whereOp);
            $sql .=' WHERE ' . $whereString;  // add the where clause
        } elseif ($where != '') {
            throw new Exception("Select must receive an associative array for the where clause");
        }

        if (is_array($groupBy)) {       // if group by is an array
            $sql .=' GROUP BY ' . implode(",", $groupBy);  // add the groupby clause
        } elseif ($groupBy != '') {
            throw new Exception("Select must receive an array for the groupBy clause");
        }

        if (is_array($orderBy)) {       // if group by is an array
            $sql .=' ORDER BY ' . implode(",", $orderBy);  // add the groupby clause
            if (($orderByType === 'ASC') or ($orderByType === 'DESC')) {
                $sql .=" " . $orderByType;
            } else {
                throw new Exception("Select must receive ASC or DESC as order by type.");
            }
        } elseif ($orderBy != '') {
            throw new Exception("Select must receive an array for the orderBy clause");
        }


        return $sql;
    }

    private function _where($where = array(), $whereOp = array()) {
        $operators = array("=", '>', "<", ">=", "<=", "<>");
        $whereString = '';
        $i = 0;
        $numItems = count($where);
        $keys = array_keys($where);
        $opKeys = array_keys($whereOp);
        if (($keys !== range(0, count($where) - 1)) & ($opKeys === range(0, count($whereOp) - 1))) {
            //if the $where array is associative and the $whereOp array is indexed
            foreach ($where as $key => $value) {
                if (in_array($whereOp[$i], $operators)) {
                    $whereString .= $key . $whereOp[$i] . "'" . $value . "'";
                    if ($i++ !== $numItems) {
                        $whereString .= ' AND ';
                    }
                } else {
                    throw new Exception("The accepted operators are: =, >, <, >=, <=, <>");
                }
            }
        }
        return $whereString;
    }

    public function fetchAll($sql, $bind = array()) {
        $stmt = $this->query($sql, $bind);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function fetchRow($sql, $bind = array()) {
        $stmt = $this->query($sql, $bind);
        $result = $stmt->fetch();
        return $result;
    }

    public function fetchOne($sql, $bind = array()) {
        $stmt = $this->query($sql, $bind);
        $result = $stmt->fetchColumn(0);
        return $result;
    }

    /**
     * Abstract Methods
     */

    abstract protected function _connect();

    abstract public function isConnected();

    abstract public function closeConnection();

    abstract public function prepare($sql);
    
    abstract public function query($sql);

    abstract public function lastInsertId($tableName = null, $primaryKey = null);
}
