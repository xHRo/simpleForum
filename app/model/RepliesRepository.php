<?php

namespace Forum;

class RepliesRepository extends Repository {
    
    public function __construct(\Nette\Database\Context $connection) {
	parent::__construct($connection);
	$this->tableName = "replies";
    }

     /**
     * Returns array of all replies with the topicId
     * @param int $topicId
     * @return array
     */
    public function getRepliesForTopic($topicId) {
        return $this->findBy(array('topic_id' => $topicId));
    }
    
    public function getRepliesForTopic2($topicId, $limit, $offset) {
        return $this->findBy(array('topic_id' => $topicId))->limit($limit, $offset);
    }
    
     /**
     * Returns count of all replies with the topicId
     * @param int $topicId
     * @return int
     */
    public function getRepliesForTopicCount($topicId) {
        return $this->findBy(array('topic_id' => $topicId))->count();
    }
    
    /**
     * Insert Reply to the database
     * @param int $topicId
     * @param int $userId
     * @param string $body
     * @param timestamp $createDate
     */
    public function addReply($topicId, $userId, $body, $createDate){
	$this->findAll()->insert(array("topic_id" => $topicId, 'user_id' => $userId, 'body' => $body, 'create_date' => $createDate,));
    }
    
    
    public function getKarma($id) {
        $data = $this->findBy(array('id' => $id))->fetch();
        return $data['karma'];
    }
    
    
    public function changeKarma($id, $value) {
        $this->findBy(array('id' => $id))->update(array("karma" => $value));

    }

}