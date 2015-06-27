<?php
namespace Forum;
use Nette\Security,
    Nette\Utils\Strings;

/**
 * User authenticator
 */
class Authenticator extends \Nette\Object implements Security\IAuthenticator {

    private $amr;
    private $ur;

    public function __construct(AuthmeRepository $amr, UserRepository $ur) {
        $this->amr = $amr;
        $this->ur = $ur;
    }

    /**
     * Performs an authentication.
     * @return Nette\Security\Identity
     * @throws Nette\Security\AuthenticationException
     */
    public function authenticate(array $credentials) {
        list($username, $password, $hash) = $credentials;

        $row = $this->amr->findByName($username);

        if (!$row) {
            throw new Security\AuthenticationException("Nesprávné uživatelské jméno.", self::IDENTITY_NOT_FOUND);
        }


        $truepass = $row['password'];
        switch ($hash) {
            case 'MD5':
                $encryptpass = hash("MD5", $password);
                break;
            case 'SHA1':
                $encryptpass = hash("SHA1", $password);
                break;
            case 'SHA256':
                $salt = explode('$', $truepass);
                $encryptpass = '$SHA$' . $salt[2] . '$' . hash("sha256", hash("sha256", $password) . $salt[2]);
                break;
        }

        if ($encryptpass !== $truepass) {
            throw new Security\AuthenticationException("Nesprávné heslo.", self::INVALID_CREDENTIAL);
        }
        
        $role = 'guest'; //default setting
        switch ($this->ur->getRole($row['id'])) {
            case '1':
                $role = 'guest';
                break;
            case '2':
                $role = 'newbie';
                break;
            case '3':
                $role = 'user';
                break;
            case '4':
                $role = 'admin';
                break;
        }
        
        //unset($row['password']);
        return new Security\Identity($row['id'], $role,
            array('confirmation' => $row['confirmation'],
                'user_in_role' => $role,
                'name' => $row['name'],
                'email' => $row['email'],
                'avatar' => $row['avatar'],
                'username' => $row['username'],
                'about' => $row['about'],
                'karma' => $row['karma'],
                'last_activity' => $row['last_activity'],
                'join_date' => $row['join_date']));
    }

}
