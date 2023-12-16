<?php

require_once ABSPATH . 'wp-content/themes/sango-theme-child-garage/templates/_common/abstarct-template-controller.php';
class Gm_Forget_Controller extends Abstract_Template_Controller
{
    public $account_attr_records = [];

    protected function setting()
    {
        parent::setting();
    }

    private function render()
    {
        require_once ABSPATH . 'wp-content/themes/sango-theme-child-garage/templates/_common/header.php';
        require 'view.php';
        require_once ABSPATH . 'wp-content/themes/sango-theme-child-garage/templates/_common/footer.php';
    }

    public function action()
    {
        // -------------------
        // メイン処理
        // -------------------.
        // echo($_POST['process']);

        if (isset($_POST['process']) && $_POST['process'] == 'forget') {
            $this->forget($_POST);
        }
        // -------------------
        // 画面描画
        // -------------------
        // $this->mode = isset($_GET['mode']) ? $_GET['mode'] : '';

        $this->render();
    }

    private function forget($params)
    {
        // -----------------
        // 入力チェック
        // -----------------
        $validation = new Gm_Validation($params);
        $validation->required([
            ['key' => 'user_id', 'name' => 'ログインID',],
         ]);
        $validation->email([
            ['key' => 'user_id', 'name' => 'ログインID',],
         ]);

        $errors = $validation->errors();
        if (!empty($errors)) {
            $this->set_input_params($params);
            $this->set_common_error('IDが違います。'); // エラー内容を見せないために強制表示
            echo("IDが違います。1");
            return;
        }

        // -----------------
        // ログイン情報チェック
        // -----------------
        $records = $this->wpdb->get_results(
            $this->wpdb->prepare("SELECT ID FROM {$this->wpdb->prefix}gmt_account WHERE email = %s", $params['user_id'])
        );
        if (empty($records)) {
            $this->set_common_error('IDが違います。');
            echo("IDが違います。2");
            return;
        }

        echo($params['user_id']);
        // -----------------
        // セッション情報保持
        // ----------------
        $to = 'info＠ar-garage.com';

        $subject = 'Hello,  I forgot my password';

        $message = 'This is my email ';

        $message .= $params['user_id'];
        
        mail($to, $subject, $message);
        
        // -----------------
        // 画面遷移
        // -----------------
        // 画面遷移
        header('Location: /login');
        exit();
    }

}
