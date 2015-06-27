<?php

namespace App\Presenters;

use Nette,
        Forum;

/**
 * Edit User Profile presenter.
 */
class EditProfilePresenter extends BasePresenter {
    
    protected $ur;
    private $userInfo;
    
    public function inject(Forum\UserRepository $ur){
	$this->ur = $ur;
    }
    
    public function renderDefault() {
        $this->userInfo = $this->ur->getUserForId($this->getUser()->id);
        $this->template->userInfo = $this->userInfo;
    }

    protected function createComponentEditProfileForm() {
        $form = new Nette\Application\UI\Form;

        $form->addText('name', 'Name: ')
                ->setRequired();
        $form->addText('email', 'Email: ')
                ->setRequired();
        $form->addText('username', 'Username: ')
                ->setRequired();
        $form->addText('password', 'Password: ')
                ->setRequired();
        $form->addText('about', 'Something about you: ')
                ->setRequired();
        //add avatar field                                              //TODO add avatar field

        $form->addSubmit('send', 'Edit');
        $this->userInfo = $this->ur->getUserForId($this->getUser()->id);     
        $defaultValues = array(
            'name' => $this->userInfo->name,
            'email' => $this->userInfo->email,
            'username'=> $this->userInfo->username,
            'password'=> $this->userInfo->password,         //TODO rewrite without MD5 hash
            'about'=> $this->userInfo->about
        );
        
        $form->setDefaults($defaultValues);
        
        $form->onSuccess[] = $this->EditProfileFormSucceeded;

        return $form;
    }

    public function EditProfileFormSucceeded($form) {
        $values = $form->getValues();

        $this->ur->editProfile($this->userInfo->id, 0, $this->userInfo->user_in_role, $values->name, $values->email,
            $values->username, $values->password, $values->about, $this->userInfo->karma, date("Y-m-d H:i:s"));

        $this->flashMessage('Profil updated', 'success'); 
        $this->redirect('Homepage:default');                    
    }

}
