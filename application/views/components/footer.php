<?php 
$this->Xin_model->update_online_user_data();
$system = $this->Xin_model->read_setting_info(1);?>
<footer class="footer">
    <div class="container-fluid">
        <?php echo date('Y');?> © Corbuz CRM
        <a style="margin-left:15px;" href="https://www.corbuz.com/privacy_and_security.html" target="blank">Privacy & Security</a>
    </div>
</footer>