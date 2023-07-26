<?php

declare(strict_types=1);

namespace Mbigha\DemoSitepackage\Domain\Model;


use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This file is part of the "DemoSitepackage" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023
 */

/**
 * User
 */
class User extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * firstName
     *
     * @var string
     */
    protected $firstName = '';

    /**
     * lastName
     *
     * @var string
     */
    protected $lastName = '';

    /**
     * image
     *
     * @var ObjectStorage<FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $image = null;

    public function __construct()
    {
        $this->initializeObject();
    }

    public function initializeObject(): void
    {
        $this->image = $this->image ?: new ObjectStorage();
    }

    /**
     * Returns the firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the firstName
     *
     * @param string $firstName
     * @return void
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns the lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the lastName
     *
     * @param string $lastName
     * @return void
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the image
     *
     * @return ObjectStorage<FileReference> $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param ObjectStorage $image
     * @return void
     */
    public function setImage(ObjectStorage $image)
    {
        $this->image = $image;
    }

    /**
     * Adds a FileReference
     *
     * @param FileReference $picture
     * @return void
     */
    public function addImage(FileReference $picture)
    {
        $this->image->attach($picture);
    }

    /**
     * Removes a FileReference
     *
     * @param FileReference $pictureToRemove The FileReference to be removed
     * @return void
     */
    public function removePicture(FileReference $pictureToRemove)
    {
        $this->image->detach($pictureToRemove);
    }
}
