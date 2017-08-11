<?php
class Dispatcher {
    private $root;
    public function __construct($path) {
        $this->root = rtrim($path, '/');
    }
    
    public function dispatch()
    {
        // パラメーター取得（末尾の / は削除）
        $param = $_SERVER['REQUEST_URI'];
        
        $params = array();
        if ('' != $param) {
            // パラメーターを / で分割
            $params = explode('/', $param);
        }
        
        // １番目のパラメーターをコントローラーとして取得
        $controller = "";
        if (0 < count($params)) {
            $controller = $params[1];
        }
        
        // パラメータより取得したコントローラー名によりクラス振分け
        $className = ucfirst(strtolower($controller)).'Controller';
        
        // クラスファイル読込
        require_once $this->root.'/Controllers/'.$className.'.php';
        
        // クラスインスタンス生成
        $controllerInstance = new $className();
        
        // 2番目のパラメーターをコントローラーとして取得
        $action= '';
        if (1 < count($params)) {
            $action= $params[2];
        }        

        // アクションメソッドを実行
        $actionMethod = $action.'Action';
        $controllerInstance->$actionMethod();
    }
}
?>