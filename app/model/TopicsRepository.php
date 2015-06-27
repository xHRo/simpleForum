<?php

namespace Forum;

class TopicsRepository extends Repository {
    
    public function __construct(\Nette\Database\Context $connection) {
	parent::__construct($connection);
	$this->tableName = "topics";
    }

    /**
     * @param int $id
     * @return database object
     */
    public function getTopic($id) {
        return $this->findBy(array('id' => $id))->fetch();
    }
    
    public function getAllTopics() {
        return $this->findAll();
    }
    
     /**
     * Returns array of strings of all topics with the categoryId
     * @param int $categoryId
     * @return array of all topic for the category
     */
    public function getTopicsForCategory($categoryId) {
        return $this->findBy(array('id' => $categoryId));
    }
    
    /**
     * Returns count of all topics with the categoryId
     * @param int $categoryId
     * @return int
     */
    public function getTopicsForCategoryCount($categoryId) {
        return $this->findBy(array('id' => $categoryId))->count();
    }
    
    
    /**
     * @param int $topicId
     * return int of user_id
     */
    public function getUserIdByTopicId($topicId) {
        $data = $this->findBy(array('id' => $topicId))->fetch();
        return $data['user_id'];
    }
    
    
    public function lockTopic($topicID) {
        $this->findBy(array('id' => $topicID))->update(array('locked' => 1));
    }
    
    public function getTopicStatus($topicID) {
        $data = $this->findBy(array('id' => $topicID))->fetch();
        return $data['locked'];
    }
    
    public function addTopic($categoryID, $userID, $state, $title, $body, $lastActivity, $createDate) {
       	$this->findAll()->insert(array("category_id" => $categoryID, 'user_id' => $userID, 'state' => $state, 'title' => $title,'body' => $body, 'last_activity' => $lastActivity, 'create_date' => $createDate));

    }
    
    
}