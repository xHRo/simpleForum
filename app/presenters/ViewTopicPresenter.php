<?php

namespace App\Presenters;

use Nette,
    Forum,
    Nette\Security\IIdentity,
    Nette\Security\User;

/**
 * Presenter for view the topic.
 */
class ViewTopicPresenter extends BasePresenter {
    private $topicID;
    private $paginator;
    public $count;
    protected $ur;
    protected $tr;
    
    /**
     * @var array of integers - contains ids of replies, which was voted by me
     */
    private $karmaValues = array();
    
    /**
     * @var associative array - represents my vote for the reply (-1/0/1)
     */
    private $karmaVotes = array();
    
    public function inject(Forum\UserRepository $ur, Forum\TopicsRepository $tr) {
        $this->ur = $ur;
        $this->tr = $tr;
    }
    
    public function actionShow($topicId, $page = 1) {
        $this->topicID = $topicId;
        
        $this->template->topicId = $topicId;
        $this->template->topic = $this->tr->getTopic($topicId);

        if (!$this->template->topic) {
            $this->error('Stránka nebyla nalezena');
        }

        //get user_id of topics founder
        $userId = $this->tr->getUserIdByTopicId($topicId);

        //get name of the user_id
        $this->template->usernameTable = $this->ur->getUserForId($userId);


        $this->template->replies = $this->rr->getRepliesForTopic($topicId);

        //zistim si k odpovedi od uzivatela info o uzivatelovi
        $this->template->userInfo = array();
        $this->template->replyInfo = array();
        foreach ($this->template->replies as $reply) {
            $this->template->userInfo[$reply['id']] = $this->ur->getUserForId($reply['user_id']);
            $this->template->replyInfo[$reply['id']] = $this->rr->getKarma($reply['id']);
        }


        $this->count = $this->rr->getRepliesForTopicCount($topicId);

        $this->paginator = new Nette\Utils\Paginator;
        $this->paginator->setItemCount($this->count);
        $this->paginator->setItemsPerPage(3);
        $this->paginator->setPage($page);

        if ($page < 1 || $page > $this->paginator->pageCount) {
            $this->flashMessage("Zle cislo stranky");
            $this->paginator->setPage(1);
        }
        
        $this->template->replies = $this->rr->getRepliesForTopic2($topicId, $this->paginator->getLength(), $this->paginator->getOffset());
	$this->template->paginator = $this->paginator;
        
        $this->template->isLocked = $this->tr->getTopicStatus($topicId);
    }
    
    protected function createComponentReplyForm() {
        $form = new Nette\Application\UI\Form;

        $form->addTextArea('content', 'Your Reply:')
                ->setRequired();

        $form->addSubmit('send', 'Reply');

        $form->onSuccess[] = $this->replyFormSucceeded;

        return $form;
    }

    public function replyFormSucceeded($form) {
        $values = $form->getValues();
        $topicId = $this->getParameter('topicId');
        $user = $this->getUser();

        $this->rr->addReply($topicId, $user->id, $values->content, date("Y-m-d H:i:s"));

        $this->flashMessage('Thank you for your comment', 'success');
        $this->redirect('this');
    }
    
    public function handleLockTopic() {
        $this->tr->lockTopic($this->topicID);
        $this->redirect('this');
    }
    
    public function handleIncreaseKarma($replyID) {
        $karmaValue = $this->rr->getKarma($replyID);
        
        if (!in_array($replyID, $this->karmaValues)) {
            $this->rr->changeKarma($replyID, ++$karmaValue);
            array_push($this->karmaValues, $replyID);
            $karmaVotes[$replyID] = 1;
        } else { 
            if ($karmaVotes[$replyID] < 1) {
                $this->rr->changeKarma($replyID, ++$karmaValue);
                $karmaVotes[$replyID] += 1;
            }
        }
        $this->redirect('this'); 
    }
    
    public function handleDecreaseKarma($replyID) {
        $karmaValue = $this->rr->getKarma($replyID);
        
        if (!in_array($replyID, $this->karmaValues)) {
            $this->rr->changeKarma($replyID, --$karmaValue);
            array_push($this->karmaValues, $replyID);
            $karmaVotes[$replyID] = -1;
        } else { 
            if ($karmaVotes[$replyID] > -1) {
                $this->rr->changeKarma($replyID, --$karmaValue);
                $karmaVotes[$replyID] -= 1;
            }
        }
        
        $this->redirect('this');
    }
    

}
