<?php
require_once('/vagrant/Models/ArticleRepository.php');
class BlogController {
    private $databaseInstance;
    public function __construct() {
        $this->databaseInstance = new ArticleRepository();
    }
    
    public function createAction() {
        $this->databaseInstance->insertArticle($_GET['title'], $_GET['content']);
    }
    
    public function showAction() {
        $result = $this->databaseInstance->selectByArticleId($_GET['id']);
        if($result == false) {
            var_dump('ERROR');
        }else {
            var_dump($result['title']);
            var_dump($result['content']);
        }
    }
    
    public function updateAction() {
        $result = $this->databaseInstance->updateArticle($_GET['id'], $_GET['title'], $_GET['content']);
        if (!$result) {
            var_dump('ERROR');
        }
    }
    
    public function deleteAction() {
        $result = $this->databaseInstance->deleteByArticleId($_GET['id']);
        if (!$result) {
            var_dump('ERROR');
        }
    }
}
?>