<?php


namespace backend\modules\profiles\infrastructure;


use backend\modules\profiles\entities\Profile;
use backend\modules\profiles\services\contracts\ProfileStorage;
use backend\modules\profiles\services\dto\ProfileEditStorageDTO;
use backend\modules\profiles\services\dto\ProfileSaveStorageDTO;
use yii\db\Connection;
use yii\db\Query;

class ProfileStorageMysql implements ProfileStorage
{
    /** @var Connection */
    private $connection;

    /**
     * ProfileStorageMysql constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(ProfileSaveStorageDTO $DTO)//: ?Profile
    {
        $dateCreated = date('Y-m-d H:i:s');
        $i = $this->connection->createCommand()->insert('user', [
                'uuid' => $DTO->getUuid(),
                'username' => $DTO->getUsername(),
                'email' => $DTO->getEmail(),
                'auth_key' => $DTO->getAuthToken(),
                'password_hash' => $DTO->getPasswordHash(),
                'status' => $DTO->getStatus(),
                'verification_token' => $DTO->getToken(),
                'created_at' => $dateCreated,
                'updated_at' => $dateCreated
            ]
        )->execute();
        if ($i == 1) {
            $id = $this->connection->getLastInsertID();
            return new Profile($DTO->getUuid(), $id, $DTO->getUsername(), $DTO->getEmail(),
                $DTO->getPasswordHash(), $DTO->getToken(), $DTO->getAuthToken(), $dateCreated, $DTO->getStatus());
        } else {
            return null;
        }
    }

    public function edit(ProfileEditStorageDTO $DTO)//: ?Profile
    {
        $dateUpdate = date('Y-m-d H:i:s');
        $i=$this->connection->createCommand()->update('user', [
                'username' => $DTO->getUsername(),
                'email' => $DTO->getEmail(),
                'password_hash' => $DTO->getPasswordHash(),
                'status' => $DTO->getStatus(),
                'updated_at' => $dateUpdate
            ], ['uuid' => $DTO->getUuid()]
        )->execute();
        if ($i == 1) {
            return true;
        } else {
            return null;
        }
    }

    public function findProfileByUsernameAndEmail(string $username, string $email)//: ?Profile
    {
        $query = new Query();
        $data = $query->from('user')
            ->andWhere(['username' => $username, 'email' => $email])
            ->one();
        if ($data) {
            return Profile::fromDataDb($data);
        }
        return null;
    }

    public function findProfileByUuid(string $uuid)//: ?Profile
    {
        $query = new Query();
        $data = $query->from('user')
            ->andWhere(['uuid' => $uuid])
            ->one();
        if ($data) {
            return Profile::fromDataDb($data);
        }
        return null;
    }
}