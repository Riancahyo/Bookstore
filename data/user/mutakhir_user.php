<!doctype html>
<html>
    <head>
        <title>Pagination with Bootstrap 3 - harviacode.com</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
        <script src="../bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <style>
            /* Custom CSS */
            .pagination, .pager {
                margin-top: 0px;
            }
            .table {
                margin-top: 20px;
            }
            .form-container {
                padding-left: 15px;
                padding-right: 15px;
                margin-left: auto;
                margin-right: auto;
                max-width: 800px; /* You can adjust the max-width as needed */
            }
            .form-title {
                margin-top: 20px;
                margin-bottom: 20px;
                text-align: center;
                font-family: sans-serif;
            }
        </style>
    </head>
    <body>
        <?php
        $kiriman = $_GET['data'];

        include "koneksi.php";  // Make sure this path is correct

        if (!isset($conn)) {
            die("Database connection not established.");
        }

        // Use mysqli to fetch data
        $stmt = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
        $stmt->bind_param("s", $kiriman);
        $stmt->execute();
        $result = $stmt->get_result();
        $data_user = $result->fetch_array(MYSQLI_NUM);

        if ($data_user) {
            echo "
            <div class='form-container'>
                <h3 class='form-title'>Edit Data User</h3>
                <form action='simpan_mutakhir_user.php' method='post'>
                    <table style='font-family:sans-serif;' class='table table-bordered'>
                        <tr>
                            <td>ID User</td>
                            <td><input class='form-control' type='text' name='id' value='$data_user[0]' readonly></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><input class='form-control' type='text' name='username' value='$data_user[1]'></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input class='form-control' type='text' name='password' value='$data_user[2]'></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><input class='form-control' type='text' name='nama' value='$data_user[3]'></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><input class='form-control' type='text' name='alamat' value='$data_user[4]'></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><input class='form-control' type='text' name='telepon' value='$data_user[5]'></td>
                        </tr>
                        <tr>
                            <td>Level</td>
                            <td>
                                <select class='form-control' name='level'>
                                    <option value='admin' " . ($data_user[6] == 'admin' ? 'selected' : '') . ">Admin</option>
                                    <option value='user' " . ($data_user[6] == 'user' ? 'selected' : '') . ">User</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type='submit' class='btn btn-primary' value='Simpan Mutakhir'></td>
                            <td><a href='index.php'><input class='btn btn-danger' type='button' value='Batal'></a></td>
                        </tr>
                    </table>
                </form>
            </div>";
        } else {
            echo "<p>User not found.</p>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </body>
</html>
