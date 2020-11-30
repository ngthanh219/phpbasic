   <?php
      include_once('header.php'); 
   ?>
        <?php
                   
                    if(isset($_SESSION['message'])){
                        echo '<div id="dialog" class="message">'.$_SESSION['message'].'</div>';
                        unset($_SESSION['message']);   
                    } 
                
                    if(isset($_SESSION['message1'])){
                        echo '<div id="dialog" class="message1">'.$_SESSION['message1'].'</div>';
                        unset($_SESSION['message1']);   
                    } 
            ?>
        <div class="content">
            <div class="topbar">
                <a href="index.php?controller=New&action=create" class="topbar-btn" title="Add account">
                    <i class="fas fa-plus-circle" aria-hidden="true"></i>
                    Thêm tin mới 
                </a>
            </div>
            <?php foreach ($tintuc as $value) : ?>
                <div class='tintuc'>        
                    <div class='column-content'>
                        <img src="<?=  $value->url_anh ?> " alt="">
                        <div class="content">
                            <h2><?=  $value->title ?></h2>
                            <p><?=  $value->content ?></p>
                            <p><?=  $value->time ?></p>
                            <p><?=  $value->tag ?></p>
                        </div>
                    </div>
                    <div class="btn">
                        <a href="index.php?controller=New&action=update&id=<?= $value->id ?>"><img src="public/images/edit.png" alt="" class="icon-edit"></a>
                        <a href="index.php?controller=New&action=destroy&id=<?= $value->id ?>" onClick="return confirm('Want to delete ?')"><img src="public/images/trash.png" alt="" class="icon-delete"></a>
                    </div>              
                </div>
            <?php endforeach ?>
        </div>
            
        <script type="text/javascript" src="public/js/tintuc.js"></script>
    </body>
    </html>