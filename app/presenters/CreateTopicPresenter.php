<?php

namespace App\Presenters;

use Nette,
    Forum;

/**
 * Homepage presenter.
 */
class CreateTopicPresenter extends BasePresenter {

    protected $tr;
    
    public function inject(Forum\TopicsRepository $tr){
	$this->tr = $tr;
    }
    

    protected function createComponentCreateTopicForm() {
        $form = new Nette\Application\UI\Form;

        $form->addText('title', 'Title: ')
                ->setRequired();
        $form->addTextArea('content', 'Content:')
                ->setRequired();

        $form->addSubmit('send', 'Create');

        $form->onSuccess[] = $this->createTopicFormSucceeded;

        return $form;
    }

    public function createTopicFormSucceeded($form) {
        $values = $form->getValues();
        $topicId = $this->getParameter('topicId');
        $user = $this->getUser();
        
        $this->tr->addTopic(1, $user->id, 1, $values->title, $values->content,  date("Y-m-d H:i:s"),  date("Y-m-d H:i:s"));
            

        $this->flashMessage('Thank you for create Topic', 'success'); 
        $this->redirect('this');                                      
    }

}
