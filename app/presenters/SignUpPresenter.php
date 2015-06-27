<?php

namespace App\Presenters;

use Nette,Forum,
    Nette\Forms\Form,
         Nette\Http;

/**
 * Homepage presenter.
 */
class SignUpPresenter extends BasePresenter {

    protected $ur;
    
    public function inject(Forum\UserRepository $ur){
        $this->ur = $ur;
    }


    protected function createComponentSignUpForm() {
        $form = new Nette\Application\UI\Form;

        $form->addText('name', 'Name: ')
                ->setRequired();
        $form->addText('email', 'Email: ')
                ->setRequired();
        /*$form->addUpload('avatar', 'Avatar: ')
                ->addRule(Form::IMAGE, 'Avatar must be JPEG, PNG, or GIF')
                ->addRule(Form::MAX_FILE_SIZE, 'Maximal 64kb'); */
        $form->addText('username', 'Username: ')
                ->setRequired();
        $form->addText('password', 'Password: ')
                ->setRequired();
        $form->addText('about', 'Something about you: ')
                ->setRequired();
        /*$form->addCheckbox('agree', 'I agree with conditions')
                ->addRule(Form::EQUAL, 'You must agree with our conditions', TRUE);*/
                
        $form->addSubmit('send', 'Create');
        

        $form->onSuccess[] = $this->SignUpFormSucceeded;

        return $form;
    }

    public function SignUpFormSucceeded($form) {
        $values = $form->getValues();
        $user = $this->getUser();
        
        $this->ur->addUser(0, 2, $values->name, $values->email, $values->username, md5($values->password),
                $values->about, 0, date("Y-m-d H:i:s"));
        

        $this->flashMessage('Thank you for your registration. On your email adress was sent email for confirmation', 'success'); //nastylovat nejako
        $this->redirect('this');                                   
    }

}
