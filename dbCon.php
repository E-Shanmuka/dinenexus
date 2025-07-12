<?php 
function connect($flag = TRUE) {
    // Check if running on Render (REMOTE ENVIRONMENT)
    if (getenv("RENDER") == "true") {
        // Render + Clever Cloud configuration
        $servername = getenv("MYSQL_ADDON_HOST") ?: "bradkac3lamfasqlmqwn-mysql.services.clever-cloud.com";
        $username = getenv("MYSQL_ADDON_USER") ?: "ur6p07imtagdxmgz";
        $password = getenv("MYSQL_ADDON_PASSWORD") ?: "8eyaJlK03htAggYfRsTb";
        $dbName   = getenv("MYSQL_ADDON_DB") ?: "bradkac3lamfasqlmqwn";
        $port     = getenv("MYSQL_ADDON_PORT") ?: 3306;
    } else {
        // Local configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "res_booking";
        $port = 3306;
    }

    // Create connection
    if ($flag) {
        $conn = new mysqli($servername, $username, $password, $dbName, $port);
    } else {
        $conn = new mysqli($servername, $username, $password, "", $port);
    }

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
