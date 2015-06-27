<?php
namespace Forum;

abstract class Repository extends \Nette\Object {
    
    protected $connection;
    protected $tableName;
    
    public function __construct(\Nette\Database\Context $connection) {
	$this->connection = $connection;
    }
    
    protected function getTable(){
        return $this->connection->table($this->tableName);
    }
    
    public function findAll(){
	return $this->getTable();
    }
    
    /**
     * Simplifies access to database
     * @param array $by
     * @return type
     */
    public function findBy(array $by){
	return $this->getTable()->where($by);
    }
}