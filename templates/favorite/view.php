<?php
if (! defined('ABSPATH')) {
    exit;
}
?>
<style>

</style>
<div class="">
    <?php
        foreach ($this->account_attr_records as $i => $record) {
            if ($this->get_input_param('account_attr_id') == $record->ID || (empty($this->get_input_param('account_attr_id')) && $i == 0)){
                $checked = 'checked';
            }
            echo '<label><input type="radio" name="account_attr_id" value="' . $record->ID . '" ' . $checked . ' >' . $record->nm . '</label>';
        }
    ?>
</div>