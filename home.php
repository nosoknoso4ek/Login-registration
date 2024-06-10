<?php
include 'db_conn.php';

// Получаем все заявки из базы данных
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task List</title>
</head>
<body>
    <h1>Task List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Вывод данных каждой строки
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"]. "</td>";
                echo "<td>" . $row["title"]. "</td>";
                echo "<td>" . $row["description"]. "</td>";
                echo "<td>" . $row["status"]. "</td>";
                echo "<td>";
                if ($row["status"] == 'new') {
                    echo '<form action="update_status.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="' . $row["id"] . '">
                            <input type="hidden" name="status" value="in_progress">
                            <input type="submit" value="Take in Work">
                          </form>';
                } elseif ($row["status"] == 'in_progress') {
                    echo '<form action="update_status.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="' . $row["id"] . '">
                            <input type="hidden" name="status" value="completed">
                            <input type="submit" value="Mark as Completed">
                          </form>';
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No tasks found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>