<?php

namespace App\Presenters;

use Nette,
    Forum;

/**
 * Presenter for view the topic.
 */
class MessagePresenter extends BasePresenter {
    protected $mr;
    protected $ur;
    
    public function inject(Forum\MessageRepository $mr, Forum\UserRepository $ur){
	$this->mr = $mr;
        $this->ur = $ur;
    }
    
    public function renderDefault() {
        $sentMessages = $this->mr->getSentMessages($this->getUser()->id);
        $this->template->sentMessages = $sentMessages;
        
        $recievedMessages = $this->mr->getRecievedMessages($this->getUser()->id);
        $this->template->recievedMessages = $recievedMessages;
    }
       
    protected function createComponentCreateMessageForm() {
        $form = new Nette\Application\UI\Form;
        
        $form->addText('name', 'For: ')
                    ->setRequired();
        $form->addText('title', 'Title: ')
                ->setRequired();
        $form->addTextArea('content', 'Content:')
                ->setRequired();

        $form->addSubmit('send', 'Create');

        $form->onSuccess[] = $this->createMessageFormSucceeded;

        return $form;
    }
    
     public function createMessageFormSucceeded($form) {
        $values = $form->getValues();
        $user = $this->getUser();
        
        $forWhom = $this->ur->getUserIDForName($values['name']);
        $this->mr->addMessage($user->id, $forWhom, $values['title'], $values['content']);

        $this->flashMessage('Message Sent !!', 'success'); 
        $this->redirect('this');
    }

    
    
    

}
