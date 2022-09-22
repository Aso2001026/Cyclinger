<?php
$host_name = $_SERVER['HTTP_HOST'];?>
<?php if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'], $host_name) !== false)) : ?>
    <button class = "back" onclick="location.href='<?php echo $_SERVER['HTTP_REFERER']?>'"><img src = "./img/back1.png" width = "30" height ="30"
                                                            onclick="location.href='<?php echo $_SERVER['HTTP_REFERER']?>'"></button>
<?php endif; ?>
