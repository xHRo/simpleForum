<?php

namespace App\Presenters;

use Nette,
    Forum;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter {

    public function renderDefault() {
        $categories = $this->cr->getAllCategories();
        
        
        //get count of topics in each category
        $numTopics = array();
        foreach ($categories as $category) {
            $numTopics[$category['id']] = $this->tr->getTopicsForCategoryCount($category['id']);
        }
        
        
        //get count of replies in each category
        $numReplies = array();
        foreach ($categories as $category) {
            $topics = $this->tr->getTopicsForCategory($category['id']);
            
            $sum = 0;
            foreach ($topics as $topic) {
                $sum = $this->rr->getRepliesForTopicCount($topic['id']);
            }
            $numReplies[$category['id']] = $sum; 
        }
        
        
        $this->template->numTopics = $numTopics;
        $this->template->categories = $categories;
        $this->template->numReplies = $numReplies;
    }





}
