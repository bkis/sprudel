<?php

    $displayDates = $poll->getDatesForDisplay();

    foreach ($poll->getEntries() as $name => $dates) {

        echo "<tr class='valign-middle'>";
        echo "<td class='schedule-names'>" . $name . "</td>";

        for ($i = 0; $i < sizeof($displayDates); $i++) {
            $value = "maybe";
            switch ($dates[$displayDates[$i]["date"]]) {
                case 0: $value = "no"; break;
                case 1: $value = "yes"; break;
                case 2: $value = "maybe"; break;
            }

            echo "<td class='schedule-entry schedule-entry-" . $value . "'></td>";

            //count result
            if ($value == "yes"){
                $displayDates[$i]["yes"]++;
            } elseif ($value == "maybe"){
                $displayDates[$i]["maybe"]++;
            } else {
                $displayDates[$i]["no"]++;
            }
        }

        if (strcmp($poll->getAdminId(), $adminId) == 0){
            $id = $poll->getId();
            echo "<td class='schedule-delete' data-poll='$id' data-name='$name' data-adminid='$adminId'>";
        }

        echo "</tr>";
    }

?>