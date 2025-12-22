<!--<a href="myapp://example.com/?hello">Click Me</a>-->

<?php
    

    if(!empty($_GET['keyreference'])){
        $reference = $_GET['keyreference'];
        
        $new = "myapp://example.com/?key=".$reference;
        
        echo '<script>window.location.href = "'.$new.'";</script>';

    }
    
    if(!empty($_GET['merch_order_id']) && !empty($_GET['prepay_id'])){
        $merch_order_id = $_GET['merch_order_id'];
        $prepay_id = $_GET['prepay_id'];
    
        $new = "myapp://example.com/?merch_order_id=".$merch_order_id."&prepay_id=.$prepay_id";
        
       echo '<script>window.location.href = "'.$new.'";</script>';

    }
    
    if(!empty($fldMerchCode)){ 
        $new = "myapp://example.com/?merch_code=".$fldMerchCode;
    ?>
    
    
    <div class="button" id="testbutton" style="text-align: center;">
    <input id="inp" style="color: #ffffff; background-color: #04aa6d; width: 170px; height: 35px; border-bottom-left-radius: 19px 3px; border-radius: 17px;"
    type="button" value="Redirect to MBT APP"/>
    </div>
    
   <script type="text/javascript">
    document.getElementById("testbutton").onclick = function () {
        location.href = "myapp://example.com/?merch_code=ok";
        document.getElementById("testbutton").style.display = "none";
    };
</script>
 
    
    <?php } ?>

