<?php
namespace Mbigha\DemoSitepackage\Domain\Finishers;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\StorageRepository;

class SaveUserDataFinisher extends AbstractFinisher
{
    private const USER_TABLE_NAME = 'fe_users';

    /**
     * Executes this finisher
     * @see AbstractFinisher::execute()
     */
    protected function executeInternal()
    {
        $formDataArray = $this->finisherContext->getFormValues();
        $this->createUserRecord($formDataArray);
    }

    private function createUserRecord(array $formData)
    {
        $usersTableConnection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable(self::USER_TABLE_NAME);

        $usersTableConnection->insert(
            self::USER_TABLE_NAME,
            [
                'first_name' => $formData['first-name'], // text-1 is the identifier of the 'First name' form field. Gotten from the form definition
                'last_name' => $formData['last-name'],
                'pid' => 1, // 1 here is just the uid of the Page record the user data will be stored in. Change according to your project
            ]
        );
        $createdUserId = (int)$usersTableConnection->lastInsertId(self::USER_TABLE_NAME);
        $imagesCount = $this->addPictures($formData, $createdUserId);
        $usersTableConnection->update(
            self::USER_TABLE_NAME,
            ['image' => $imagesCount],
            ['uid' => $createdUserId],
            [Connection::PARAM_INT]
        );
    }

    private function addPictures(array $formData, int $userId)
    {
        $storageRepository = GeneralUtility::makeInstance(StorageRepository::class);
        $storage = $storageRepository->getDefaultStorage();
        $userFolderIdentifier = 'user_upload' . '/' .strtolower($formData['first-name']) . '-' . strtolower($formData['last-name']);
        if (!$storage->hasFolder($userFolderIdentifier)){
            $storage->createFolder($userFolderIdentifier);
        }

        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('sys_file_reference');
        foreach ($formData['user-pictures'] as $picture){
            // Adds each uploaded picture to the storage (in this case, the local filesystem)
            $fileObject = $storage->addFile(
                $picture['tmp_name'],
                $storage->getFolder($userFolderIdentifier),
                $picture['name']
            );

            // Creates the file reference for each uploaded picture and the created 'fe_users' record. The pictures will be available
            // on the 'image' property of an object from the 'fe_users' table.
            $connection->insert(
                'sys_file_reference',
                [
                    'table_local' => 'sys_file',
                    'uid_local' => (int)$fileObject->getUid(),
                    'tablenames' => 'fe_users',
                    'uid_foreign' => $userId,
                    'fieldname' => 'image',
                    'pid' => 1, // 1 here is just the uid of the Page record the file reference data will be stored in. Change according to your project
                ]
            );
        }

        return $connection->count(
            '*',
            'sys_file_reference',
            [
                'tablenames' => 'fe_users',
                'fieldname' => 'image',
                'uid_foreign' => $userId
            ]
        );
    }
}