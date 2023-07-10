<?    include("config.php");

    $q = "SELECT * FROM registry WHERE ! ISNULL(modified) ORDER BY modified DESC LIMIT 10";
    $stmt = mysqli_prepare($dbLink, $q);
    mysqli_stmt_execute($stmt);
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
                $all_records[] = $row;
        }

    $json_array = json_encode($all_records);
    print $json_array;
    exit();
