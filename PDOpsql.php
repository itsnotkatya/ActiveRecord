<?php

function connect(): PDO
{
    $host='localhost';
    $db = 'labs';
    $user = 'admin';
    $password = 'admin';
   try { $dsn = "mysql:host=$host;port=3306;dbname=$db;";
        return new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch (PDOException $e) {die($e->getMessage());}
        return new PDO(
            $dsn,
            $user,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        die($e->getMessage());
    } finally {
        echo '+';
    }
}

return connect();
