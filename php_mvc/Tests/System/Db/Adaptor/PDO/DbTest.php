<?php

require_once 'System/Db/Adaptor/PDO/Db.php';

class DbTest extends PHPUnit_Framework_TestCase {

    protected $db;

    protected function setUp() {

        $this->db = new Db(array('host' => 'localhost', 'dbname' => 'test', 'username' => 'root', 'password' => 'root'));
        $this->db->prepare(null); //to create the connection
        $class = get_class($this->db);
        $this->assertEquals("Db", $class);
    }

    public function testIsConnected() {
        $c = $this->db->isConnected();
        $this->assertTrue($c);
    }

    public function testCloseConnection() {
        $c = $this->db->closeConnection();
        $this->assertNull($c);
    }

    public function testPrepare() {
        $stmt = $this->db->prepare('Select * from users');
        $class = get_class($stmt);
        $this->assertEquals("PDOStatement", $class);
    }

    //$badValue
    public function testQuery() {
        $result = $this->db->query("Update users set firstname='iunia' where iduser=1");
        $this->assertTrue($result);
    }

    public function testExec() {
        $result = $this->db->exec("Update users set firstname = 'iunia' where iduser = 1");
        $this->assertTrue($result);
    }

    /**
     * @expectedException Exception
     * 
     */
    public function testQueryBadValues() {
        $result = $this->db->query('alabalaportocala', array('notOk' => 'Value'));
        var_dump($result);
    }

    /**
     * @expectedException Exception
     * 
     */
    public function testExecBadValues() {
        $result = $this->db->exec('alabalaportocala');
    }

}

