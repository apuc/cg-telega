<?php


namespace workspace\modules\telegram\models;


use Longman\TelegramBot\DB;
use Longman\TelegramBot\Exception\TelegramException;
use PDO;
use PDOException;


class CGDB extends DB
{
    const TB_USER = 'user';


    public static function setDB()
    {

    }

    public static function isExistUser(int $id)
    {

        if (!self::isDbConnected()) {
            throw new TelegramException('DB was not set!');
        }

        $users = self::getUsers();
        foreach ($users as $user) {
            if ($user['id'] === (string)$id) {
                return true;
            }
        }

        return false;
    }

    public static function getUsers()
    {
        if (!self::isDbConnected()) {
            return false;
        }

        try {
            $sql = '
                SELECT *
                FROM `' . TB_USER . '`
            ';

            $sth = self::$pdo->prepare($sql);

            $sth->execute();

            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new TelegramException($e->getMessage());
        }
    }
}