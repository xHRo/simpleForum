<?php

namespace App\Presenters;

use Nette,
        Forum;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {

    protected $amr;
    protected $cr;
    protected $tr;
    protected $rr;
    protected $ur;

    public function injectBase(Forum\CategoriesRepository $cr, Forum\TopicsRepository $tr,
            Forum\RepliesRepository $rr, Forum\UserRepository $ur) {
        $this->cr = $cr;
        $this->tr = $tr;
        $this->rr = $rr;
        $this->ur = $ur;
    }
        
    /**
     * Sign-in form factory.
     * @return Nette\Application\UI\Form
     */
    protected function createComponentLoginForm() {
        $form = new Nette\Application\UI\Form;
        $form->addText('username', 'Username:')
                ->setRequired('Please enter your username.');

        $form->addPassword('password', 'Password:')
                ->setRequired('Please enter your password.');

        $form->addSubmit('send', 'Sign in');

        // call method signInFormSucceeded() on success
        $form->onSuccess[] = $this->signInFormSucceeded;
        return $form;
    }

    public function signInFormSucceeded($form, $values) {
        try {
            $this->getUser()->login($values->username, $values->password, $this->context->parameters['authmeHash']);
            $this->redirect('this');
        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError($e->getMessage());
        }
    }

    public function handleLogout() {
        $this->user->logout(TRUE);
        $this->flashMessage('Odhlášení proběhlo úspěšně.', 'info'); //toto potom nejak prerobiť aby to krajšie písalo
        $this->redirect('Homepage:');
    }

}
