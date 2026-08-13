<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Leap Year</title>
</head>
<body>
    <form method="GET">
        <label for="country">Country:</label>
        <input type="text" name="country"/>

        <label for="yearUnit">Year unit:</label>
        <input type="number" name="yearUnit"/>

        <input type="submit" value="Enter">
    </form>
</body>
</html>

<?php
    function checkLeapYear($yearUnit, $country) {
        //get data
        $json = file_get_contents("data/data.json");
        $data = json_decode($json, true);

        $country_formatted = trim(ucwords($country));
        $country_birth = $data[$country_formatted];

        $prefix = "";
        $lastTwoDigits = $yearUnit % 100;
        $lastDigit = $yearUnit % 10;

        // get the prefix, like nd, st, th
        switch ($lastTwoDigits) {
            case 11:
            case 12:
            case 13:
                $prefix = "th";
                break;

            default:
                switch ($lastDigit) {
                    case 1:
                        $prefix = "st";
                        break;
                    case 2:
                        $prefix = "nd";
                        break;
                    case 3:
                        $prefix = "rd";
                        break;
                    default:
                        $prefix = "th";
                        break;
                }
                break;
        }

        //main logic
        $result = ($country_birth + $yearUnit) % 4;

        if($result === 0) {
            echo "$yearUnit$prefix birthday of $country is a leap year";
        } else {
            echo "$yearUnit$prefix birthday of $country is not a leap year";
        }
    }

    if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["country"]) && isset($_GET["yearUnit"])) {
        $country = $_GET["country"];
        $yearUnit = $_GET["yearUnit"];
        checkLeapYear($yearUnit, $country);
    }
?>