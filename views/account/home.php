<?php
    include 'header.php';
?>
        <div class="content">
            <div class="topbar">
                <a href="index.php?controller=Account&action=create" class="topbar-btn" title="Add account">
                    <i class="fas fa-plus-circle" aria-hidden="true"></i>
                    Thêm tài khoản mới
                </a>
            </div>
            <div class="container-wrapper">
                <div class="list-data">
                    <div class="item active">
                        <div class="col_checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="col_name item-active">Fullname</div>
                        <div class="col_username item-active">Email</div>
                        <div class="col_password item-active">Password</div>
                        <div class="actions item-active">Actions</div>
                    </div>
                    <div class="scroll-wapper">
                        <div class="scroll-wapper-view">
                            <div class="list">
                                <?php foreach($account as $value): ?>
                                <div class="item">
                                    <div class="col_checkbox">
                                        <input type="checkbox">
                                    </div>
                                    <div class="col_name"><?= $value->name ?></div>
                                    <div class="col_username"><?= $value->email ?></div>
                                    <div class="col_password"><?= $value->password ?></div>
                                    <div class="actions">
                                        <a class="icon" href="index.php?controller=Account&action=create&id=<?= $value->id ?>" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                            <div class="title"><i class="fas fa-caret-up"></i><span>Chỉnh sửa</span></div>
                                        </a>
                                        <a class="icon" href="index.php?controller=Account&action=destroy&id=<?= $value->id ?>" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                            <div class="title"><i class="fas fa-caret-up"></i><span>Xóa</span></div>
                                        </a>
                                    </div>
                                </div>    
                                <?php endforeach; ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if(isset($_SESSION['message'])){
                echo '<div id="dialog" class="message">'.$_SESSION['message'].'</div>';
                unset($_SESSION['message']);   
            }
        ?>
    </div>
    <script type="text/javascript" src="public/js/account.js"></script>
</body>
</html>