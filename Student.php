<?php
$pdo = require 'PDOpsql.php';


class Student
{
    private $course;
    private $firstName;
    private $secondName;
    private $UNI;
    private $groupNumber;


    public function __construct($course, $firstName, $secondName, $UNI, $groupNumber)
    {
        $this->course = $course;
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->UNI = $UNI;
        $this->groupNumber = $groupNumber;
    }
    /**
     * @return mixed
     */

    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @return mixed
     */
    public function getfirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getsecondName()
    {
        return $this->secondName;
    }

    /**
     * @return mixed
     */
    public function getUNI()
    {
        return $this->UNI;
    }

    /**
     * @return mixed
     */
    public function getgroupNumber()
    {
        return $this->groupNumber;
    }

    public function save($pdo) : bool {
        $stmt = $pdo->prepare("INSERT INTO Student (course, firstName, secondName, UNI, groupNumber) values(?,?,?,?,?)");
        $stmt->bindParam(1, $this->course, PDO::PARAM_INT);
        $stmt->bindParam(2, $this->firstName, PDO::PARAM_STR, 50);
        $stmt->bindParam(3, $this->secondName, PDO::PARAM_INT, 50);
        $stmt->bindParam(4, $this->UNI, PDO::PARAM_INT, 10);
        $stmt->bindParam(5, $this->groupNumber, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function remove($pdo) {
        $stmt = $pdo->prepare("Delete from Student where course = ?, firstName = ?, secondName = ?, UNI = ?, groupNumber = ? ");
        $stmt->bindParam(1, $this->course, PDO::PARAM_INT);
        $stmt->bindParam(2, $this->firstName, PDO::PARAM_STR, 50);
        $stmt->bindParam(3, $this->secondName, PDO::PARAM_INT, 50);
        $stmt->bindParam(4, $this->UNI, PDO::PARAM_INT, 10);
        $stmt->bindParam(5, $this->groupNumber, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getById($pdo,$id): Student
    {
        $stmt = $pdo->prepare("Select * from Student where id = ? ");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new Student($row['course'],$row['firstName'],$row['secondName'], $row['UNI'], $row['groupNumber']);
    }
    public function all($pdo): array
    {
        $stmt = $pdo->query("SELECT course,firstName,secondName,UNI,grooupNumber FROM Student");
        $tableList = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tableList[] = array('course'=>$row['course'], 'firstName'=>$row['firstName'], 'secondName'=>$row['secondName'], 'UNI'=>$row['UNI'],'groupNumber'=>$row['groupNumber']);
        }
        return $tableList;
    }
    public function getByField($fieldValue,$pdo): array
    {
        $stmt = $pdo->prepare("Select ? from Student");
        $stmt->bindParam(1, $fieldValue, PDO::PARAM_INT);
        $stmt->execute();
        $tableList = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tableList[] = array('course'=>$row['course'], 'firstName'=>$row['firstName'], 'secondName'=>$row['secondName'], 'UNI'=>$row['UNI'],'groupNumber'=>$row['groupNumber']);
        }
        return $tableList;
    }

}
