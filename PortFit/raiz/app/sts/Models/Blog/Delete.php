<?php

namespace Sts\Models\Blog;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR Blog
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // DELETAR BLOG
    public function deleteBlog($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM blog WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    // DELETAR TODOS POST DO BLOG DE UM FUNCIONARIO
    public function deleteBlogEmployee($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM blog WHERE employee_id = :employee_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':employee_id' => $id
        ]);
    }

    // DELETAR CATEGORIA
    public function deleteCategory($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM blog_category WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    // DELETAR COMENTARIO
    public function deleteComment($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM blog_comment WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }


    // DELETAR TODOS COMENTARIOS DE UM POST
    public function deleteAllCommentPost($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM blog_comment WHERE blog_id = :blog_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':blog_id' => $id
        ]);
    }


    


}