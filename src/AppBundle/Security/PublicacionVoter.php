<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 9/02/16
 * Time: 16:45
 */

namespace AppBundle\Security;


use AppBundle\Entity\Publicacion;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Edgar\UserBundle\Entity\User;

class PublicacionVoter extends Voter
{
    const EDITAR_PUBLICACION = 'EDIT';
    private $accessDecisionManager;
    public function __construct(AccessDecisionManagerInterface $accessDecisionManager)
    {
        $this->accessDecisionManager = $accessDecisionManager;
    }
    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if ($attribute != PublicacionVoter::EDITAR_PUBLICACION) {
            return false;
        }
        if (!$subject instanceof Publicacion) {
            return false;
        }
        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }
        /**
         * @var Publicacion $publicacion
         */
        $publicacion = $subject;
        return $this->accessDecisionManager->decide($token, ['ROLE_ADMIN']) or $publicacion->getAutor() === $user;
    }
}