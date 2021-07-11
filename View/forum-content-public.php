<h1><?= $forum["title"] ?></h1>
    <div class="user">
        <p> <?php 
            if(is_array($author)){
                echo $author["username"];
            }
            ?> 
            <div class="vertical2">
                <div class="vertical">
                    <span id="<?=$forum["idpost"]?>" class="<?php if($foruml){echo "vote2";} else{echo "vote";}?>" onclick="like(this)"></span>
                </div>
                <div class="vertical">
                    <span id="p<?=$forum["idpost"]?>"> <?=$forumlc?></span>
                </div>
            </div>
        </p>
    </div>
    <div>
        <p><?= $forum["content"] ?> </p>
    </div>
    <div class="uppload-date">
        
        <p><?= date("h:i d/m/Y",strtotime($forum["time"])) ?></p>
    </div>
    <div class="edit">
            <?php if(isset($_SESSION["id"])){
                if(end($_SESSION["id"]) == $author["iduser"]){
                    echo ' <form  action="'. BASE_URL . 'forum" method="post">
                    <input type="hidden" name="idpost" value="' . $forum["idpost"] . '" />
                    <input type="hidden" name="edit" value="1" />
                    <button id="e' . $forum["idpost"] . '" type="submit"> edit </button>
                    </form>';
                    if($forum["removed"] == 0){
                        //echo '<a id="e' . $forum["idpost"] . '" onclick="edit(this)"> edit </a> |';
                        echo '<a id="pr' . $forum["idpost"] . '" onclick="private(this, 1)"> private </a>';
                    }
                    else{
                        //echo '<a id="e' . $forum["idpost"] . '" onclick="edit(this)"> edit </a> |';
                        echo '<a id="pr' . $forum["idpost"] . '" onclick="private(this, 0)"> make public </a>';
                    }
                }
            }?>
    </div>
</div>