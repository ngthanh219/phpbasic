<?php
    include 'header.php';
?>
        <div class="content">
            <?php
                $title = $href = $button = "";
                $id = $name = $email = $password = "";
                $checkInputNoneEmail = false;
                if(isset($account)){
                    $checkInputNoneEmail = true;
                    foreach ($account as $value) {
                        $id = $value->id;
                        $name = $value->name;
                        $email = $value->email;
                    }
                    $href = "index.php?controller=Account&action=update&id=".$id;
                    $title = "Cập nhật: ".$email;
                    $button = "Cập nhật";
                }else{
                    $href = "index.php?controller=Account&action=stoge";
                    $title = "Thêm mới người dùng";
                    $button = "Thêm mới";
                }
            ?>
            <form id="form" action="<?= $href ?>" method="POST">
                <div class="form-wrapper">
                    <div class="row_title">
                        <?= $title; ?>
                    </div>
                    <div class="row_item">
                        <div class="left">Name</div>
                        <div class="right">
                            :
                            <span class="input">
                                <input type="text" name="name" id="name" value="<?= $name ?>">
                            </span>
                        </div>
                    </div>
                    <div class="nameMess error">
                        <?php
                            if(isset($_SESSION['checkErrorName'])){
                                if($_SESSION['checkErrorName'] == true){
                                    if(isset($_SESSION['messageErrorName'])){
                                        echo $_SESSION['messageErrorName'];
                                        unset($_SESSION['messageErrorName']);  
                                    } 
                                }else{
                                    echo '';
                                }
                            }
                        ?>
                    </div>
                    <?php
                        if(!$checkInputNoneEmail){
                    ?>
                    <div class="row_item">
                        <div class="left">Email</div>
                        <div class="right">
                            :
                            <span class="input">
                                <input type="text" name="email" id="email" value="<?= $email ?>">
                            </span>
                        </div>
                        <div class="question">
                            <div class="title">
                                <i class="fas fa-question-circle"></i>
                                <span>Nhập đúng định dạng email</span>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="emailMess error">
                        <?php
                            if(isset($_SESSION['checkErrorEmail'])){
                                if($_SESSION['checkErrorEmail'] == true){
                                    if(isset($_SESSION['messageErrorEmail'])){
                                        echo $_SESSION['messageErrorEmail'];
                                        unset($_SESSION['messageErrorEmail']);  
                                    } 
                                }else{
                                    echo '';
                                }
                            }
                            if(isset($_SESSION['checkEmail'])){
                                if(isset($_SESSION['messageErrorEmail'])){
                                    echo $_SESSION['messageErrorEmail'];
                                    unset($_SESSION['messageErrorEmail']);  
                                }
                            }else{ echo ''; }
                        ?>
                    </div>
                    <div class="row_item">
                        <div class="left">Password</div>
                        <div class="right">
                            :
                            <span class="input">
                                <input type="password" name="password" id="password" value="<?= $password ?>">
                            </span>
                        </div>
                        <div class="question">
                            <div class="title">
                                <i class="fas fa-question-circle"></i>
                                <span>Password không quá 15 ký tự</span>
                            </div>
                        </div>
                    </div>
                    <div class="passwordMess error">
                        <?php
                            if(isset($_SESSION['checkErrorPass'])){
                                if($_SESSION['checkErrorPass'] == true){
                                    if(isset($_SESSION['messageErrorPass'])){
                                        echo $_SESSION['messageErrorPass'];
                                        unset($_SESSION['messageErrorPass']);  
                                    } 
                                }else{
                                    echo '';
                                }
                            }
                        ?>
                    </div>
                    <div class="row_btn">
                        <button class="btn">
                            <span>
                                <?= $button; ?>
                            </span>
                        </button>
                        <div class="btn">
                            <span>
                                <a style="display: block" href="index.php?controller=Account&action=index">Quay lại</a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="public/js/account.js"></script>
</body>
</html>