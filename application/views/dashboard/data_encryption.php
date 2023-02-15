<style>
.shadow-textarea textarea.form-control::placeholder {
    font-weight: 300;
}
.shadow-textarea textarea.form-control {
    padding-left: 0.8rem;
    -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
}
</style>

<div class="box box-block bg-white" align="center">
    <img class="img-fluid" style="max-width:150px" src="<?php echo site_url('skin/img/security.png'); ?>"/>
    <br><br><h1 class="display-4">Data Encryption</h1>
    <h4>Check how we store your data!</h4>
    <br>
    <div class="form-group shadow-textarea">
        <textarea class="form-control z-depth-1" id="enctxtinput" rows="4" placeholder="Write something here..."></textarea>
    </div>
    <h5>We are storing your data like this</h5>
    <div class="form-group shadow-textarea">
        <textarea readonly class="form-control z-depth-1" id="enctxtoutput" rows="4"></textarea>
    </div>
</div>