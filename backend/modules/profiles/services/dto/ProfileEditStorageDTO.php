<?php


namespace backend\modules\profiles\services\dto;


class ProfileEditStorageDTO
{
    //private $uuid;
    private $username;
    private $email;
    private $password_hash;
    private $status;

    /**
     * ProfileEditStorageDTO constructor.
     * @param $username
     * @param $email
     * @param $password_hash
     * @param $status
     *
     */

    public function __construct( $username, $email, $password_hash, $status)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->status = $status;
        //$this->uuid = $uuid;
    }

    /**
     * @return mixed
     */
    //public function getUuid()
    //{
    //    return $this->uuid;
    //}
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPasswordHash()
    {
        return $this->password_hash;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

}