<?php 
if(end($_SESSION["id"]) == $author["iduser"]){
    echo "<h1>This post has been made private</h2>";
    include ("View/forum-content-public.php");
}
else{
    echo '<div class="post">
    <h2>This post has been made private.</h2>
    </div>';
}
?>
