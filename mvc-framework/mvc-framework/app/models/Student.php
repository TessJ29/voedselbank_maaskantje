<?php
/**
 *  Student model hoort bij de students controller 
 *
 */

 class Student 
 {
    // Properties
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLessons()
    {
        $this->db->query(
            'SELECT lessen.*, leerling.* 
             FROM lessen 
             INNER JOIN leerling 
             ON leerling.Id = lessen.leerling 
             AND leerling.Id = 3'
        );
        $result = $this->db->resultSet();
        return $result;
    }

    public function getLessonsToCancel()
    {
        $this->db->query('SELECT Les.*, Les.ID, INSTR.*, leerling1.*
                          FROM Les
                          INNER JOIN Instructeur AS INSTR
                          ON Les.InstructeurId = INSTR.Id
                          INNER JOIN Leerling1
                          ON Les.LeerlingId = Leerling1.Id
                          WHERE Les.LeerlingId = 3
                          AND Les.Is_geannuleerd = 0');
        $result = $this->db->resultSet();
        return $result;
    }

    public function removeLesson($post)
    {
        // var_dump($post); exit();
        $this->db->query("INSERT INTO annuleerLes (Id, LesId, Reden) 
                          VALUES (NULL, '{$post["Id"]}','{$post["reason"]}')");
        $this->db->execute();
        $this->db->query("UPDATE Les SET Is_geannuleerd = 1 WHERE Id = {$post['Id']}");
        $this->db->execute();
    }

    public function addRemark($post)
    {
        $this->db->query(
            "INSERT INTO opmerkingen (ID, 
                                      Les, 
                                      Opmerkingen) 
             VALUES                  (NULL, 
                                      :Id, 
                                      :remark);"
        );
       
        $this->db->bind(':Id', $post['Id'], PDO::PARAM_STR);
        $this->db->bind(':remark', $post['remark'], PDO::PARAM_STR);

        return $this->db->execute();
    }
 }