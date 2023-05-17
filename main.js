$(document).ready(function() {

    $("body").append(`<div class='ourBanner19988' style="  background: #eee;
    height: 70px;
    width: 70px;
    position: fixed;
    bottom: 30px; 
    right: 30px; 
    display:flex; align-items:center; text-align:center; 
    justify-content:center;
    border-radius: 50%; cursor:pointer;">
      <img src="image/bot_avatar.png" style="height:50px; width:50px; border-radius:50%; ">
    </div>`);

    $(".ourBanner19988").click(function() {
        $(".ourBanner19988").hide();
        $("body").append(`<iframe src="index.php" class='ourFrame19988' style="
    height: 450px;
    width: 350px;
    position: fixed;
    bottom: 30px; 
    border:none;
    right: 30px; 
    padding: 0px;
    display:flex; align-items:center; text-align:center; 
    border-radius: 8px;
    overflow:hidden;
    ">
    </iframe>`);

        $("body").append(`<div  class='ourClose19988' style="
    height: 50px;
    width: auto;
    position: absolute;
    bottom: 480px; 
    right: 30px;
    font-size: 21px;
    font-weight:300; 
    padding: 0px;
    display:flex; align-items:center; text-align:center; 
    border-radius: 8px;
    overflow:hidden; cursor:pointer; font-family:arial;
    "> KS CONSULTANT 
    </div> 
    `);

        $("body").append(`<div  class='ourClose19988' onclick="closeAll()" style="
    height: 50px;
    width: 50px;
    position: absolute;
    bottom: 460px; 
    right: 360px;
    font-size:36px;
    font-weight:300; 
    padding: 0px; 
    color: #9889; 
    display:flex; align-items:center; text-align:center; 
    border-radius: 8px;
    overflow:hidden; cursor:pointer; font-family:arial;
    "> X
    </div>
    <script>
    function closeAll() { 
        $(".ourFrame19988").hide();
        $(".ourBanner19988").show();
        $(".ourClose19988").hide();
    };
    </script>
    `);



    });


});