
<script type="text/javascript">

    $(document).ready(function() {
        // show poll url
        var pollUrl = window.location.protocol + "//" + window.location.hostname + window.location.pathname + "?poll=<?php echo $poll->getId() ?>";
        $("#urlInfo").val(pollUrl);
        $("#admUrl").val(pollUrl + "&adm=<?php echo $adminId ?>");
        
        // url clipboard copy feature
        var clipboard = new ClipboardJS(".copy-trigger");
        clipboard.on("success", function(e) {
            $(e.trigger).addClass("copy-success").addClass("copy-success").delay(600).queue(function(){
                $(this).removeClass("copy-success").dequeue();
            });
        });
        clipboard.on("error", function(e) {
            alert("<?php echo SPR_URL_COPY_ERROR ?>");
            $(e.trigger).addClass("copy-fail").delay(2000).queue(function(){
                $(this).removeClass("copy-fail").dequeue();
            });
        });
        
        // delete entry button functionality
        $(".schedule-delete").click(function(){
            if (confirm("<?php echo SPR_REMOVE_CONFIRM ?> '" + $(this).attr("data-name") + "' ?")){
                $.post( "entry.delete.php", { pollId: $(this).attr("data-poll"), name: $(this).attr("data-name"), adm: $(this).attr("data-adminid") } ).done( function() {
                    location.href = location.href;
                });
            }
        });
        
        // delete poll button functionality
        $("#btnDeletePoll").click(function(){
            if (confirm("<?php echo SPR_DELETE_POLL_CONFIRM ?>")){
                $.post( "poll.delete.php", { pollId: "<?php echo $poll->getId() ?>", adm: "<?php echo $poll->getAdminId() ?>" } ).done( function() {
                    location.href = "index.php";
                });
            }
        });
        
        // cycle through options (ugly, but works for now)
        $(".new-entry-box").click(function(){
            console.log("yes")
            if ($(this).hasClass("new-entry-choice-maybe")){
                $(this).removeClass("new-entry-choice-maybe");
                $(this).addClass("new-entry-choice-yes");
                $(this).children(".entry-value").attr("value", "1");
            } else if ($(this).hasClass("new-entry-choice-yes")){
                $(this).removeClass("new-entry-choice-yes");
                $(this).addClass("new-entry-choice-no");
                $(this).children(".entry-value").attr("value", "0");
            } else if ($(this).hasClass("new-entry-choice-no")) {
                $(this).removeClass("new-entry-choice-no");
                $(this).addClass("new-entry-choice-maybe");
                $(this).children(".entry-value").attr("value", "2");
            }
            
        });
        
        // mini-view toggler
        $("#btnMiniView").click(function(){
            if ($("#btnMiniView").attr("data-miniview") == "off"){
                $("table.schedule").addClass("mini");
                $("#btnMiniView").attr("data-miniview", "on");
                $("#btnMiniView").text("Normal View");
            } else {
                $("table.schedule").removeClass("mini");
                $("#btnMiniView").attr("data-miniview", "off");
                $("#btnMiniView").text("Mini View");
            }
        });
        
    });

</script>