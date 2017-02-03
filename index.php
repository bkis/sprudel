<?php
	if (isset($_POST["title"]) && strlen($_POST["title"]) > 0
		&& isset($_POST["dates"])){
		
		require_once 'db.php';

		$title = htmlspecialchars($_POST["title"]);
		$details = htmlspecialchars($_POST["details"]);
		$dates = array_values(array_unique($_POST["dates"]));
		$id = hash("md4", time() . $title);

		//write data to polls table
		$database->action(function($database) use ($id, $title, $details) {
			$database->insert("polls", [
				"poll" => $id,
				"title" => $title,
				"details" => $details,
				"changed" => date("Y-m-d H:i:s")
			]);
		});

		//prepare dates
		$datesArr = array();
		for ($i=0; $i < sizeof($dates); $i++) { 
			array_push($datesArr, array("poll" => $id, "date" => $dates[$i], "sort" => $i));
		}

		//write data to dates table
		$database->action(function($database) use ($datesArr) {
			$database->insert("dates", $datesArr);
		});

		//redirect to poll
		header("Location: poll.php?poll=" . $id);
		exit();
	}

	$currDate = date("Y-m-d");
	include "header.php";
?>


<div class="centerBox">
	<form action="index.php" method="post">
		<ul class="pudelform">
		    <li>
		        <label><?php echo P_NEW_FORM_TITLE ?> <span class="required">*</span></label>
		        <input type="text" name="title" class="field-long" required="true" id="titleInput" placeholder="<?php echo P_NEW_FORM_TITLE_PLACEHOLDER ?>" />
		    </li>
		    <li>
		        <label><?php echo P_NEW_FORM_DESCRIPTION ?> </label>
		        <textarea name="details" class="field-long field-textarea" placeholder="<?php echo P_NEW_FORM_DETAILS_PLACEHOLDER ?>"></textarea>
		    </li>
		    <li>
		        <label><?php echo P_NEW_FORM_DATES ?> <span class="required">*</span></label>
		        <input type="text" name="dates[]" maxlength="16" class="dateInput field-long" data-toggle="datepicker" required="true" placeholder="<?php echo P_NEW_FORM_DATES_PLACEHOLDER ?>" />
		    </li>
		    <li>
		    	<img src="img/icon-more.png" class="btnFormDate" id="btnMore"/>
		    	<img src="img/icon-less-disabled.png" class="btnFormDate" id="btnLess"/>
		    	<img src="img/icon-calendar.png" class="btnFormDate" id="btnDate"/>
		    </li>
		    <li class="content-right">
		        <input type="submit" value="<?php echo P_NEW_FORM_SUBMIT ?>" />
		    </li>
		</ul>
	</form>
</div>


<script type="text/javascript">

	$(document).ready(function() {

		$("#titleInput").focus();

		var datepickerOptions = {
			trigger: '#btnDate',
			format: '<?php echo P_DATEPICKER_FORMAT ?>',
			autoHide: 'true',
			weekStart: 1,
			language: '<?php echo P_DATEPICKER_LANG ?>'
		};

		$(".dateInput").last().datepicker(datepickerOptions);

		$("#btnMore").click(function() {
			$(".dateInput").last().datepicker('destroy');
            $(".dateInput").last().after("<input type='text' name='dates[]' class='dateInput field-long' required='true' style='margin-top: 4px;' />");
            $(".dateInput").last().val($(".dateInput:nth-last-child(2)").val());
            $(".dateInput").last().focus();
            $(".dateInput").last().select();
			$(".dateInput").last().datepicker(datepickerOptions);
			$("#btnLess").attr("src", "img/icon-less.png");
        });

        $("#btnLess").click(function() {
        	$(".dateInput").not(':first').last().datepicker('destroy');
            $(".dateInput").not(':first').last().detach();
            $(".dateInput").last().focus();
            $(".dateInput").last().select();
            $(".dateInput").last().datepicker(datepickerOptions);
            if ($(".dateInput").size() == 1){
            	$("#btnLess").attr("src", "img/icon-less-disabled.png");
            }
        });

        $("#btnDate").click(function() { //TODO: DATEPICKER (res schon drin!)
        	//$(".dateInput").last().val("<?php echo $currDate ?>");
            //$(".dateInput").last().focus();
            //$(".dateInput").last().select();
        });

	});

</script>


<?php include "footer.php" ?>