<?php
class ArticleRepository {
    private $pdo;
    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=blog_app;charset=utf8','dbuser','nagoya20010',array(PDO::ATTR_EMULATE_PREPARES => false));
        } catch (PDOException $e) {
            exit('データベース接続失敗。'.$e->getMessage());
        }
    }
    public function insertArticle($title, $content) {
        $stmt = $this->pdo->prepare("INSERT INTO articles (title, content, create_time, update_time) VALUES (:title, :content, cast( now() as datetime), cast( now() as datetime))");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function selectByArticleId($id) {
        $stmt = $this->pdo->prepare("SELECT title, content FROM articles WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function updateArticle($id, $title, $content) {
        $pre = $this->pdo->prepare("SELECT * FROM articles WHERE id = :id");
        $pre->bindValue(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch();
        $stmt = $this->pdo->prepare('UPDATE articles set title = :title, content = :content, update_time = cast( now() as datetime) WHERE id = :id');
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $result;
        
    }
    public function deleteByArticleId($id) {
        $pre = $this->pdo->prepare("SELECT * FROM articles WHERE id = :id");
        $pre->bindValue(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch();
        $stmt = $this->pdo->prepare('DELETE FROM articles WHERE id = :delete_id');
        $stmt -> bindParam(':delete_id', $id, PDO::PARAM_INT);
        $stmt -> execute();
        return $result;
    }
}
?>