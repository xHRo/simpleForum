<?php

namespace Forum;

class CategoriesRepository extends Repository {
    
    public function __construct(\Nette\Database\Context $connection) {
	parent::__construct($connection);
	$this->tableName = "categories";
    }

    /**
     * @param int $id
     * return string name of the category
     */
    public function getCategoryName($id) {
        $data = $this->findBy(array('id' => $id))->fetch();
        return $data['name'];
    }
    
    public function getAllCategories() {
        return $this->findAll();
    }

}