<?php if(isset($_SESSION['msg']) && isset($_SESSION['msg']['content'])): ?>
    <div class="alert alert-<?= $_SESSION['msg']['type'] ?> alert-dismissible fade show" role="alert">
        <strong><?= $_SESSION['msg']['content'] ?>!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php 
endif;
unset($_SESSION['msg']);
?>