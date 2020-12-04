<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/style_addForm.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="form" >
        <a href="index.php?controller=New&action=index"><img src="public/images/Sun-Logotype-RGB-01.png" alt=""></a>
        <form method="POST" action="index.php?controller=New&action=stoge" >
       <div class="form-add">
           <h1 class="h1-text">Title</h1>
           <input type="text" name="title" placeholder="Your title ... " size="60" >
                <?php
                    if(isset($_SESSION['errorLength'])){
                    echo '<div id="dialog" class="errorLength">'.$_SESSION['errorLength'].'</div>';
                    unset($_SESSION['errorLength']);   
                    } 
                ?>
           <h1 class="h1-text">Content</h1>
           <textarea name="content" id="" cols="60" rows="10" placeholder="Your content ..."></textarea>
                <?php
                    if(isset($_SESSION['errorLength1'])){
                    echo '<div id="dialog" class="errorLength">'.$_SESSION['errorLength1'].'</div>';
                    unset($_SESSION['errorLength1']);   
                    } 
                ?>
           <h1 class="h1-text">Link Picture</h1>
           <input type="text" name="url_anh" placeholder="Your url ...">
                <?php
                if(isset($_SESSION['errorLength3'])){
                    echo '<div id="dialog" class="errorLength">'.$_SESSION['errorLength3'].'</div>';
                    unset($_SESSION['errorLength3']);   
                    } 
                ?>
           <h1 class="h1-text">Tag</h1>
           <input type="text" name="tag" placeholder="Your tag ...">
                <?php
                    if(isset($_SESSION['errorLength2'])){
                    echo '<div id="dialog" class="errorLength">'.$_SESSION['errorLength2'].'</div>';
                    unset($_SESSION['errorLength2']);   
                    } 
                ?>
           <div class="btn">
              <button type="submit" class="add-btn">Add</button>
           </div>
       </div>
       </form>
    </div>
</body>
</html>