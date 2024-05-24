<?php

namespace Sts\Models\Exam;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR exames
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR EXAME
    public function createExam($exam) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO exam (
            height,
            weight,
            idealWeight,
            leanMass,
            idealLeanMass,
            fatMass,
            idealFatMass,
            tbw,
            idealTbw,
            ecw,
            idealEcw,
            icw,
            idealIcw,
            systolic,
            diastolic,
            smoke,
            alcoholic,
            injuries,
            allergy,
            deficiency,
            surgeries,
            pains,
            dateExam,
            student_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $exam['height'],
            $exam['weight'],
            $exam['idealWeight'],
            $exam['leanMass'],
            $exam['idealLeanMass'],
            $exam['fatMass'],
            $exam['idealFatMass'],
            $exam['tbw'],
            $exam['idealTbw'],
            $exam['ecw'],
            $exam['idealEcw'],
            $exam['icw'],
            $exam['idealIcw'],
            $exam['systolic'],
            $exam['diastolic'],
            $exam['smoke'],
            $exam['alcoholic'],
            $exam['injuries'],
            $exam['allergy'],
            $exam['deficiency'],
            $exam['surgeries'],
            $exam['pains'],
            $exam['dateExam'],
            $exam['student_id']
        ]);
    }


}