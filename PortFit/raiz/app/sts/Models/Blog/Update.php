<?php

namespace Sts\Models\Blog;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR blog
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ALTERAR BLOG
    public function updateBlog($blog) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE blog SET
            title = ?,
            banner = ?,
            category_id = ?,
            post = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $blog['title'],
            $blog['banner'],
            $blog['category_id'],
            $blog['post'],
            $blog['id']
        ]);
    }

    // ALTERAR SITUACAO DO BLOG
    public function updateSituation($blog) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE blog SET 
            situation = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $blog['situation'],
            $blog['id']
        ]);
    }


    // ALTERAR VIEWS DO BLOG
    public function updateViews($views, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE blog SET 
            views = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $views,
            $id
        ]);
    }

     // ALTERANDO DISPARA DE EMAIL DO POST
     public function updateSendEmail($post) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE blog SET 
            send_email = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $post['send_email'],
            $post['id']
        ]);
    }


    // ALTERANDO CATEGORIA
    public function updateCategory($category) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE blog_category SET 
            name = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $category['name'],
            $category['id']
        ]);
    }


   

}