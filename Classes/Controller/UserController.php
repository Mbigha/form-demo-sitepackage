<?php

declare(strict_types=1);

namespace Mbigha\DemoSitepackage\Controller;


/**
 * This file is part of the "DemoSitepackage" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023
 */

/**
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * userRepository
     *
     * @var \Mbigha\DemoSitepackage\Domain\Repository\UserRepository
     */
    protected $userRepository = null;

    /**
     * @param \Mbigha\DemoSitepackage\Domain\Repository\UserRepository $userRepository
     */
    public function injectUserRepository(\Mbigha\DemoSitepackage\Domain\Repository\UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $users = $this->userRepository->findAll();
        $this->view->assign('users', $users);
        return $this->htmlResponse();
    }
}
