<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Utitlisateur</title>
    <link rel="stylesheet" href="../css/patient.css">
    <style>
        .th-table, .td-table {
            width: 12.5%;
        }
    </style>
</head>
<body>
    <?php 
        session_start();
        if (!isset($_SESSION['username']) and !isset($_SESSION['cin_user'])) {
            if ($_SESSION['Admin'] == 1) {
                echo '<script>alert("Your Are Not Admin 🔒");';
                echo 'window.location.assign("index.php")</script>';
            }
            echo '<script>alert("please login ❗❗");';
            echo 'window.location.assign("../../index.php")</script>';
        }
        include_once 'side__bar.php';
    ?>

    <main class="main">
        <div class="sub_main">
                <div class="add-new">
                    <section class="container">
                        <button class="add-new-button" data-hover="Add new patient" id="add-new-button" onclick="add_new()">
                        <div><i class="fas fa-plus-square"></i></div>
                    </button>
                    </section>
                </div>
                <div class="search__div">
                    <div class="wrap">
                        <div class="search">
                            <input type="text" id="search" class="searchTerm" placeholder="What are you looking for?">
                            <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-table" id="container-table">
                <table class="table-table" id="table-table">
                    <thead class="thead-table">
                        <tr class="tr-table-head">
                            <th class="th-table">CIN</th>
                            <th class="th-table">Nom</th>
                            <th class="th-table">Prenom</th>
                            <th class="th-table">Username</th>
                            <th class="th-table">Password</th>
                            <th class="th-table">Email</th>
                            <th class="th-table">Permission</th>
                            <th class="th-table">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-table">
                        <?php 
                            include_once 'connect.php';
                            $sql = "SELECT * FROM utilisateur";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                    <tr class="tr-table-main row_' . $row['cin_U'] . '">
                                        <td class="td-table cin_U">' . $row['cin_U'] . '</td>
                                        <td class="td-table nom">' . $row['nom'] . '</td>
                                        <td class="td-table prenom">' . $row['prenom'] . '</td>
                                        <td class="td-table user_name">' . $row['user_name'] . '</td>
                                        <td class="td-table password">'; if ($row['Admin'] == 0) {echo $row['password'];}else{ echo "********</td>";}
                                        echo
                                        '
                                        <td class="td-table Email">' . $row['email'] . '</td>
                                        <td class="td-table permission">';
                                            if ($row['Admin'] == 0) {
                                                echo 'Utitlisateur';
                                            }else {
                                                echo 'Admin';
                                            }
                                        echo'</td>
                                        <td class="td-table">';
                                        if ($row['Admin'] == 0) {
                                            echo '<a href="#" onclick="showinput('."'row_".$row['cin_U']."'".')"><i class="fas fa-edit"></i></a>';
                                            echo '<a onclick="varif_delete('."'".$_SESSION['password']."','".$row['cin_U']."'".')"><i class="fas fa-trash-alt"></i></a>';
                                            echo '<a id="'.$row['cin_U'].'" href="delete_User.php?cin_U='.$row['cin_U'].'"></a>';
                                        }else {
                                            echo '<a href="#" onclick="alert('."'🙄Cell Devlopper🙄'".')"><i class="fas fa-edit"></i></a>';
                                            echo '<a onclick="alert('."'❌you can`t delete this Admin❌'".')"><i class="fas fa-trash-alt"></i></a>';
                                        }
                                        echo '
                                        </td>
                                    </tr>
                                    </tr>';
                                    if ($row['Admin'] == 0) {
                                        echo 
                                        '<tr class="tr-table hide hide_row_'.$row['cin_U'].'">
                                            <td colspan="8" style="padding: 0;">
                                                <form method="post" action="edit_User.php">
                                                    <table style="border-collapse: collapse;width: 100%;">
                                                        <tr class="tr-table">
                                                            <input type="hidden" name="cin_U_init" value="'.$row['cin_U'].'" />
                                                            <td class="td-table"><input type="text" name="cin_U" value="'.$row['cin_U'].'" required></td>
                                                            <td class="td-table"><input type="text" name="nom" value="'.$row['nom'].'" required></td>
                                                            <td class="td-table"><input type="text" name="prenom" value="'.$row['prenom'].'" required></td>
                                                            <td class="td-table"><input type="text" name="user_name" value="'.$row['user_name'].'" required></td>
                                                            <td class="td-table"><input type="password" name="password" value="'.$row['password'].'" required></td>
                                                            <td class="td-table"><input type="text" name="email" value="'.$row['email'].'" required></td>
                                                            <td class="td-table">
                                                                <label>User<input type="radio" name="admin" value="0" checked></label>
                                                                <label>Admin<input type="radio" name="admin" value="1"></label>
                                                            </td>
                                                            <td class="td-table">
                                                            <input type="submit" id="'.$row['cin_U'].'" value="Enregistre" name="enregistre_patien">
                                                            <i class="fas fa-times-circle" onclick="deleteinput('."'row_".$row['cin_U']."'".')"></i>
                                                        </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </td>
                                        </tr>
                                            ';
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
    </main>
    <script>
        $(document).ready(function(){
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".tr-table-main").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

            function add_new() {
                var add = document.createElement("TR")
                add.classList.add('add-new-ontable')
                add.innerHTML = `
                <td colspan='8'>
                    <form method="post" action="add_new_user.php">
                        <table style="border-collapse: collapse;width: 100%;">
                            <tr class="tr-table add">
                                <td class="td-table">
                                    <input type="text" name="CIN" id="cin" required>
                                </td>
                                <td class="td-table">
                                    <input type="text" name="Nom" id="Nom" required>
                                </td>
                                <td class="td-table">
                                    <input type="text" name="Prenom" id="Prenom" required>
                                </td>
                                <td class="td-table">
                                    <input type="text" name="User_name" id="User_name" required>
                                </td>
                                <td class="td-table">
                                    <input type="password" name="password" id="password" required>
                                </td>
                                <td class="td-table">
                                    <input type="text" name="email" id="email">
                                </td>
                                <td class="td-table">
                                    <label>User<input type="radio" name="admin" value="0" checked></label>
                                    <label>Admin<input type="radio" name="admin" value="1"></label>
                                </td>
                                <td class="td-table">
                                    <input type="submit" value="Enregistre" onclick="myFunction()" name="enregistre_patien">
                                    <i class="fas fa-times-circle" onclick="deleteinputt()"></i>
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            `
                document.getElementsByClassName('tbody-table')[0].appendChild(add)
                document.getElementById('add-new-button').disabled = true
            }

            function deleteinputt() {
                document.getElementsByClassName("add-new-ontable")[0].remove()
                document.getElementById('add-new-button').disabled = false
            }


            function showinput(hide) {
                var cell = document.getElementsByClassName(hide)[0]
                cell.style.display = 'none';
                var input = document.getElementsByClassName('hide_' + hide)[0]
                input.style.display = 'table-row';
            }


            function deleteinput(hide) {
                var cell = document.getElementsByClassName(hide)[0]
                cell.style.display = 'table-row';
                var input = document.getElementsByClassName('hide_' + hide)[0]
                input.style.display = 'none';
            }


            function varif_delete(password,cin_U) {
                var pass = prompt("Type Password Admin");
                if (pass == password) {
                    document.getElementById(cin_U).click()
                }
                else if(pass != null){
                    alert("password incorect")
                }
            }
    </script>
</body>
</html>