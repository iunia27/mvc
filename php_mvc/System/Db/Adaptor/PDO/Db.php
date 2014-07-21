<?php

class Db extends DB_Abstract {

    protected function _connect() {
        // if we already have a PDO object, no need to re-connect.
        if ($this->_connection) {
            return;
        }

        // check for PDO extension
        if (!extension_loaded('pdo')) {
            throw new Exception('The PDO extension is required for this adapter but the extension is not loaded');
        }

        // create PDO connection
        $dsn = 'mysql:host=' . $_config['host'] . ";dbname" . $_config['dbname'];
        try {
            $this->_connection = new PDO(
                            $dsn,
                            $this->_config['username'],
                            $this->_config['password']
            );
        } catch (PDOException $e) {

            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function isConnected() {
        return ((bool) ($this->_connection instanceof PDO));
    }

    public function closeConnection() {
        $this->_connection = null;
    }

    public function prepare($sql) {
        $this->_connect();
        $stmt = $this->_connection->prepare($sql);
        return $stmt;
    }

    public function lastInsertId($tableName = null, $primaryKey = null) {
        $this->_connect();
        return $this->_connection->lastInsertId();
    }

    /**
     * 
     * @param type $sql
     * @param type $bind 
     * Returns true if the query succeeded, false otherwise
     */
    public function query($sql, $bind = array()) {
        try {
            $stmt = $this->connection->prepare($sql);    //prepare statement
            return $stmt->execute($bind);    //execute query       
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function exec($sql) {

        try {
            $this->_connection->exec($sql);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

}

