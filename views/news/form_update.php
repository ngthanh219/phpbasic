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
        <a href="index.php?controller=home_controller&action=index"><img src="public/images/Sun-Logotype-RGB-01.png" alt=""></a>

        <?php
          if(isset($_SESSION['errorLength'])){
            echo '<div id="dialog" class="errorLength">'.$_SESSION['errorLength'].'</div>';
            unset($_SESSION['errorLength']);   
        } 
        ?>

        
 <?php foreach($tintuc as $value) : ?>
        <form method="POST" action="index.php?controller=New&action=doUpdate&id=<?= $value->id ?>" >
                    <?php 
                        foreach($tintuc as $value) {
                            $time = date('Y-m-d', strtotime($value->time));
                        }

                    ?>  
              
                    <div class="form-add">
                        <input type="hidden" name="id" value="<?= $value->id ?>">
                        <h1 class="h1-text">Title</h1>
                        <input type="text" name="title" placeholder="Your title ... " size="60" value="<?= $value->title ?>">
                        <h1 class="h1-text">Content</h1>
                        <textarea name="content"  cols="60" rows="10" placeholder="Your content ..." ><?= $value->content ?></textarea>
                            
                        <h1 class="h1-text">Link Picture</h1>
                        <input type="text" name="url_anh" placeholder="Your url ..." value="<?= $value->url_anh ?>">
                        <h1 class="h1-text">Tag</h1>
                        <input type="text" name="tag" placeholder="Your tag ..." value="<?= $value->tag?>">
                        <div class="btn">
                            <button type="submit" class="add-btn">Edit</button>
                        </div>
                    </div>

            <?php endforeach;  ?>
       </form>
    </div>
</body>
</html>