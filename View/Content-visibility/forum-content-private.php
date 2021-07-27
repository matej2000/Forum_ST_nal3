<?php 
if(end($_SESSION["id"]) == $author["iduser"]){
    echo '<h2 class="private">This post has been made private</h2>';
    include ("View/Content-visibility/forum-content-public.php");
}
else{
    echo '<div class="post">
    <h2 class="private">This post has been made private</h2>
    </div>';
}
?>
