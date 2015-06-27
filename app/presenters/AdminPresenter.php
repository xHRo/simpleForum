<?php

namespace App\Presenters;

use Nette\Application\UI\Form;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;

/**
 * Presenter for admin stuffs
 */
class AdminPresenter extends BasePresenter {
    
    /**
     * Contact form
     */
    protected function createComponentContactForm() {
        $form = new Form;
        $form->addText('name', 'Jméno:')
            ->addRule(Form::FILLED, 'Zadejte jméno');
        $form->addText('email', 'Email:')
            ->addRule(Form::FILLED, 'Zadejte email')
            ->addRule(Form::EMAIL, 'Email nemá správný formát');
        $form->addTextarea('message', 'Zpráva:')
            ->addRule(Form::FILLED, 'Zadejte zprávu');
        $form->addSubmit('send', 'Odeslat');

        $form->onSuccess[] = $this->processContactForm;

        return $form;
    }


    /**
     * Process contact form, send message
     * @param Form
     */
    public function processContactForm(Form $form) {
        $values = $form->getValues(TRUE);

        $message = new Message;
        $message->addTo('myofficialemail@centrum.sk')
            ->setFrom($values['email'])
            ->setSubject('Zpráva z kontaktního formuláře')
            ->setBody($values['message']);

        
        $mailer = new SendmailMailer;
        $mailer->send($message);
        
        $this->flashMessage('Zpráva byla odeslána');
        $this->redirect('this');
    }

    
    

}
