<!--<a href="myapp://example.com/?hello">Click Me</a>-->

<?php
    $reference = $_GET['keyreference'];
    $new = "myapp://example.com/?key=".$reference;
    echo '<script>window.location.href = "'.$new.'";</script>';
?>