<?php

namespace App\Presenters;

use Nette,
    App\Model;

/**
 * Presenter to view all the topics from the category.
 */
class ViewCategoryPresenter extends BasePresenter {
    
    public function renderDefault($categoryId) {
        $topics = $this->tr->getTopicsForCategory($categoryId);
           
        $lastActivity = array();
        $numReplies = array();
        
        foreach ($topics as $topic) {
            $lastActivity[$topic['id']] = $topic['last_activity'];
            $numReplies[$topic['id']] = $this->rr->getRepliesForTopicCount($topic['id']);       
        }
        
        $this->template->topicsInCategory = $topics;
        $this->template->lastActivity = $lastActivity;
        $this->template->numReplies = $numReplies;
        $this->template->categoryName = $this->cr->getCategoryName($categoryId);
        
    }

}
