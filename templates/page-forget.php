<?php
/* Template Name:【ガレージ】ログインパスワードを忘れる
 * Template Post Type: page
 */
?>
<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<?php
require_once locate_template('templates/forget/controller.php');
new Gm_Forget_Controller();
?>