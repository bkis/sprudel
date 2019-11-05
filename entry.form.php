<form action="entry.new.php" method="post">
<input type="hidden" name="pollId" value="<?php echo $poll->getId() ?>"/>
<input type="hidden" name="pollAdminId" value="<?php echo $adminId ?>"/>
    <td class="schedule-name-input">
        <input type="text" id='name-input' name="name" maxlength="32" placeholder="<?php echo SPR_POLL_NAME ?>" required="true" />
    </td>
    <?php
        foreach ($poll->getDates() as $date) {
            echo "<td class='new-entry-box new-entry-choice new-entry-choice-maybe'>";
            echo "<input class='entry-value' type='hidden' name='values[]' value='2'/>";
            echo "<input class='entry-date' type='hidden' name='dates[]' value='" . $date["date"] . "'/>";
            echo "</td>";
        }
    ?>
    <td class="schedule-submit">
        <input type="submit" value="<?php echo SPR_ENTRY_SAVE ?>" class="save" />
    </td>
</form>