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
                    if($forum["removed"] == 0){
                        echo '<a src=""> edit </a> |';
                        echo '<a id="pr' . $forum["idpost"] . '" onclick="private(this, 1)"> private </a>';
                    }
                    else{
                        echo '<a src=""> edit </a> |';
                        echo '<a id="pr' . $forum["idpost"] . '" onclick="private(this, 0)"> make public </a>';
                    }
                }
            }?>
    </div>
</div>