<?php

namespace Sts\Models\Blog;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER posts do blog
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    private $situation = true;

    // BUSCANDO BLOG POR ORDEM DE ID MAIS NOVO
    public function allBlog($amount, $start) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT blog.*,
                blog_category.name AS category,
                employees.fullName AS author,
                employees.photo
                FROM blog
                LEFT JOIN blog_category ON blog.category_id = blog_category.id
                LEFT JOIN employees ON blog.employee_id = employees.id
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO BLOG PELO CAMPO DE PESQUISA
    public function blogSearch($amount, $start, $search) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT blog.*,
                blog_category.name AS category,
                employees.fullName AS author,
                employees.photo
                FROM blog
                LEFT JOIN blog_category ON blog.category_id = blog_category.id
                LEFT JOIN employees ON blog.employee_id = employees.id
                WHERE blog.title LIKE :title
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('title', $search);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO BLOG PELO CAMPO DE PESQUISA - SOMENTE SITUACAO ATIVA
    public function blogSearchActive($amount, $start, $search) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT blog.*,
                blog_category.name AS category,
                employees.fullName AS author,
                employees.photo
                FROM blog
                LEFT JOIN blog_category ON blog.category_id = blog_category.id
                LEFT JOIN employees ON blog.employee_id = employees.id
                WHERE blog.title LIKE :title
                AND blog.situation = :situation
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('title', $search);
        $stmt->bindParam('situation', $this->situation);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO BLOG DE UMA CATEGORIA - SOMENTE SITUACAO ATIVA
    public function blogCategoryActive($amount, $start, $category) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT blog.*,
                blog_category.name AS category,
                employees.fullName AS author,
                employees.photo
                FROM blog
                LEFT JOIN blog_category ON blog.category_id = blog_category.id
                LEFT JOIN employees ON blog.employee_id = employees.id
                WHERE blog.category_id = :category_id
                AND blog.situation = :situation
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('category_id', $category);
        $stmt->bindParam('situation', $this->situation);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO BLOG POR ORDEM DO NOME
    public function blogOrderName($amount, $start, $order) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT blog.*,
                blog_category.name AS category,
                employees.fullName AS author,
                employees.photo
                FROM blog
                LEFT JOIN blog_category ON blog.category_id = blog_category.id
                LEFT JOIN employees ON blog.employee_id = employees.id
                ORDER BY blog.title $order
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO BLOG POR ATIVO OU INATIVO
    public function blogSituation($amount, $start, $situation) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT blog.*,
                blog_category.name AS category,
                employees.fullName AS author,
                employees.photo
                FROM blog
                LEFT JOIN blog_category ON blog.category_id = blog_category.id
                LEFT JOIN employees ON blog.employee_id = employees.id
                WHERE blog.situation = $situation
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO BLOG POR ID
    public function blogId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT blog.*,
                blog_category.name AS category,
                employees.fullName AS author,
                employees.photo
                FROM blog
                LEFT JOIN blog_category ON blog.category_id = blog_category.id
                LEFT JOIN employees ON blog.employee_id = employees.id
                WHERE blog.id = :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // BUSCANDO BLOG POR ID - SOMENTE SE SITUACAO ATIVA
    public function blogIdActive($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT blog.*,
                blog_category.name AS category,
                employees.fullName AS author,
                employees.photo
                FROM blog
                LEFT JOIN blog_category ON blog.category_id = blog_category.id
                LEFT JOIN employees ON blog.employee_id = employees.id
                WHERE blog.id = :id
                AND blog.situation = :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->bindParam("situation", $this->situation);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // BUSCANDO BLOG POR ID - SOMENTE SE SITUACAO ATIVA E SEND_EMAIL FOR TRUE
    public function blogIdSendEmail($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();
        $sendEmail = true;

        $sql = "SELECT blog.*,
                blog_category.name AS category,
                employees.fullName AS author,
                employees.photo
                FROM blog
                LEFT JOIN blog_category ON blog.category_id = blog_category.id
                LEFT JOIN employees ON blog.employee_id = employees.id
                WHERE blog.id = :id
                AND blog.send_email = :send_email
                AND blog.situation = :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->bindParam("send_email", $sendEmail);
        $stmt->bindParam("situation", $this->situation);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // BUSCANDO POSTS PUBLICOS DO BLOG POR ORDEM DE ID MAIS NOVO
    public function blog($amount, $start) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT blog.*,
                blog_category.name AS category,
                employees.fullName AS author,
                employees.photo
                FROM blog
                LEFT JOIN blog_category ON blog.category_id = blog_category.id
                LEFT JOIN employees ON blog.employee_id = employees.id
                WHERE blog.situation = :situation
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('situation', $this->situation);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    // BUSCANDO TODOS POST DO BLOG CRIADO POR UM FUNCIONARIO
    public function AllBlogEmployee($employee) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM blog
                WHERE employee_id = :employee_id
                ORDER BY id DESC
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('employee_id', $employee);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO POST MAIS VISTOS - SOMENTE SITUACAO ATIVA
    public function blogMostView($limit) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM blog 
                WHERE situation = :situation
                ORDER BY views DESC
                LIMIT $limit
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('situation', $this->situation);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // ------------------- COMENTARIOS -------------------
    // BUSCANDO QUANTIDADE DE COMENTARIOS DE UM POST
    public function commentCount($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM blog_comment
                WHERE blog_id = :blog_id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('blog_id', $id);
       
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // BUSCANDO COMENTARIOS DE UM POST
    public function comments($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM blog_comment
                WHERE blog_id = :blog_id
                ORDER BY date DESC
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('blog_id', $id);
       
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    
    // ----------------------------- BUSCANDO QUANTIDADES -----------------------------
    // FUNCAO PARA QUNATIDADE DE REGISTRO
    public function count() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM blog";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUNATIDADE DE REGISTRO - SOMENTE SE SITUACAO TIVER ATIVA
    public function countActive() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM blog WHERE situation = :situation";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('situation', $this->situation);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUANTIDADE DE REGISTRO ACHADO EM CAMPO DE PESQUISA
    public function countSearch($search) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM blog
                WHERE title LIKE :title
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('title', $search);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUANTIDADE DE REGISTRO ACHADO EM CAMPO DE PESQUISA - SOMENTE SITUACAO ATIVA
    public function countSearchActive($search) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM blog
                WHERE title LIKE :title
                AND situation = :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('title', $search);
        $stmt->bindParam('situation', $this->situation);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUANTIDADE DE REGISTRO ACHADO DE UMA CATEGORIA - SOMENTE SITUACAO ATIVA
    public function countCategoryActive($category) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM blog
                WHERE category_id = :category_id
                AND situation = :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('category_id', $category);
        $stmt->bindParam('situation', $this->situation);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUANTIDADE DE REGISTRO DE ATIVO OU INATIVO
    public function countSituation($situation) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM blog
                WHERE situation LIKE :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('situation', $situation);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    
    // ----------------------------- BUSCANDO CATEGORIAS -----------------------------
    // BUSCANDO TODAS CATEGORIAS
    public function allCategory() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM blog_category ORDER BY name ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO ULTIMA CATEGORIA
    public function lastCategory() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT id FROM blog_category ORDER BY id DESC LIMIT 1";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // CHECANDO SE CATEGORIA ESTA VINCULADA A ALGUM POST
    public function usingCategory($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM blog WHERE category_id = :category_id LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('category_id', $id);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // BUSCANDO CATEGORIA POR NOME
    public function categoryBlogName($name) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM blog_category
                WHERE name = :name
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('name', $name);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }
}