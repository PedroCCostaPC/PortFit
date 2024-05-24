<?php

namespace Sts\Models\Blog;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR blog
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR BLOG
    public function createBlog($blog) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO blog (
            title,
            published,
            banner,
            post,
            views,
            situation,
            employee_id,
            category_id,
            send_email
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $blog['title'],
            $blog['published'],
            $blog['banner'],
            $blog['post'],
            $blog['views'],
            $blog['situation'],
            $blog['employee_id'],
            $blog['category_id'],
            $blog['send_email']
        ]);
    }

    // CRIAR CATEGORIA
    public function createCategory($category) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO blog_category (
            name
        ) VALUES (?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $category
        ]);
    }


    // CRIAR COMENTARIO
    public function createComment($comment) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO blog_comment (
            name,
            email,
            comment,
            date,
            blog_id
        ) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $comment['name'],
            $comment['email'],
            $comment['comment'],
            $comment['date'],
            $comment['blog_id']
        ]);
    }
}