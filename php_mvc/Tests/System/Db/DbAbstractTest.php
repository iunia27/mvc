<?php

require_once 'System/Db/DbAbstract.php';

class DbAbstractTest extends PHPUnit_Framework_TestCase {

    protected $dbAbstract;

    protected function setUp() {
            
        $this->dbAbstract = $this->getMockBuilder('DbAbstract')
                ->setConstructorArgs(array(array('host' => 'localhost', 'dbname' => 'test', 'username' => 'root', 'password' => 'root')))
                ->setMethods(array('_connect', 'closeConnection', 'prepare', 'query', 'isConnected', 'exec'))
                ->getMock();
        //create a mock object that has all the methods DBAbstract has, except the abstract methods 
        //give a config array as parameters for the constructor

        $this->dbAbstract->expects($this->any())
                ->method('query')
                ->will($this->returnArgument(0));

        $this->dbAbstract->expects($this->any())
                ->method('prepare')
                ->will($this->returnCallback(function($sql) {
                                    $connection = new PDO('mysql:host=localhost;dbname=test', 'root', 'root');
                                    return $connection->prepare($sql);
                                })
        );
        //change the query method to return the sql statement

        $class = get_class($this->dbAbstract);
        $this->assertStringStartsWith("Mock_DbAbstract_", $class);
    }

    public function testGetConnection() {
        $c = $this->dbAbstract->getConnection();
    }

    public function testInsert() {
        $insert = $this->dbAbstract->insert('users', array('firstname' => 'iun', 'lastname' => 'buj', 'email' => 'iun.buj@softvision.ro', 'password' => sha1(12345)));
        $this->assertEquals("INSERT INTO users(firstname,lastname,email,password) VALUES('iun','buj','iun.buj@softvision.ro','" . sha1(12345) . "')", $insert);
        $insert = $this->dbAbstract->insert('users', array(127, 'iun', 'buj', 'iun.buj@softvision.ro', sha1(12345)));
        $this->assertEquals("INSERT INTO users VALUES('127','iun','buj','iun.buj@softvision.ro','" . sha1(12345) . "')", $insert);
    }

    public function updateBadValues() {
        return array(
            array(
                array('users', array("name" => "iunia"), array("id" => 1), array("a"))
            ),
            array(
                array('users', array("iunia"), array("id" => 1), array("="))
            ),
            array(
                array('users', array("name" => "iunia"), 'where', array("="))
            ),
//            array(
//                array('users', null, array(), array())
//            ),
        );
    }

    /**
     * @dataProvider updateBadValues
     * @expectedException Exception
     */
    public function testUpdateBadValues($badValue) {
        $this->dbAbstract->update($badValue[0], $badValue[1], $badValue[2], $badValue[3]);
    }

    public function testUpdate() {
        $c = $this->dbAbstract->update('users', array("name" => "iunia"), array("id" => 1), array("="));
        $this->assertEquals("UPDATE users SET name='iunia' WHERE id=1", $c);
    }

    /**
     * @expectedException Exception
     */
    public function testDelete() {
        $delete = $this->dbAbstract->delete('users');
        $this->assertEquals("DELETE FROM users", $delete);
        $delete = $this->dbAbstract->delete('users', array("id" => 1), array("="));
        $this->assertEquals("DELETE FROM users WHERE id=1", $delete);
        $delete = $this->dbAbstract->delete('users', array("id" => 1, "age" => 25), array("=", ">"));
        $this->assertEquals("DELETE FROM users WHERE id=1 AND age>25", $delete);
        $delete = $this->dbAbstract->delete('users', array("name" => "iunia"), array("=", ">"));
        $this->assertEquals("DELETE FROM users WHERE name='iunia'", $delete);
        $delete = $this->dbAbstract->delete('users', array("id" => "1"), array()); //delete from users where ?
        $this->dbAbstract->delete('users', array());  //throws exception
    }

    public function selectBadValues() {
        return array(
            array(
                array("a", 'users', array("name" => "iunia"), array("id" => 1), array("a"), null, null)
            ),
            array(
                array(1, 'users', array("id" => 1), array("id" => 1), array("="), null, null)
            ),
            array(
                array(array('name', 'age'), 'users', 'string', array("name" => "iunia"), array("="), null, null)
            ),
            array(
                array('*', 'users', array("id" => 1), array("name" => "iunia"), 'string', null, null)
            ),
            array(
                array('*', 'users', array("id" => 1), array("name" => "iunia"), array("name"), 'ASOC', null)
            ),
            array(
                array('*', 'users', array("id" => 1), array("name" => "iunia"), array("name"), array("name"), 'ASOC')
            ),
        );
    }

    /**
     * @dataProvider selectBadValues
     * @expectedException Exception
     */
    public function testSelectBadValues($badValue) {
        $this->dbAbstract->select($badValue[0], $badValue[1], $badValue[2], $badValue[3], $badValue[4], $badValue[5], $badValue[6]);
    }

    public function testSelect() {
        $select = $this->dbAbstract->select('*', 'users', array('id' => 1), array("="), array("name"), array("name"), 'ASC');
        $this->assertEquals('SELECT * FROM users WHERE id=1 GROUP BY name ORDER BY name ASC', $select);
    }

    public function testFetchAll() {
        $fetchAll = $this->dbAbstract->fetchAll('SELECT * from users');
        $this->assertInternalType('array', $fetchAll);
        $this->assertGreaterThan(5, count($fetchAll));
    }

    public function testFetchRow() {
        $fetchRow = $this->dbAbstract->fetchRow('SELECT * from users');
        $this->assertInternalType('array', $fetchRow);
    }

    public function testFetchOne() {
        $fetchOne = $this->dbAbstract->fetchOne('SELECT * from users');
        $this->assertInternalType('string', $fetchOne);
    }

}

