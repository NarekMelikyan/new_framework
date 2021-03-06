<?php

if(isset($_SESSION)){
    if($_SESSION['email'] !== $_COOKIE['user']){
        header('Location: /');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyMVC index page</title>
</head>
<body>
<form action="/account/logout" method="post">
    <button type="submit">Logout</button>
</form>
<h1>This is index page !!</h1>
<h3 style="text-decoration: underline">Users List</h3>
<table border="1">
    <tr>
        <th>#ID</th>
        <th>Name</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php
    foreach ($variables['users'] as $user) {
        echo '<tr>';
        echo '<td>' . $user['id'];
        echo '</td>';
        echo '<td>' . $user['name'];
        echo '</td>';
        echo '<td>';
        echo '<form action="/update_username" method="post">
                    <input type="text" name="name">
                    <input type="hidden" name="id" value="'.$user['id'].'">
                    <button type="submit">Update</button>
                </form>';
        echo '</td>';
        echo '<td>';
        echo '<form action="/delete_user" method="post">
                    <input type="hidden" name="id" value="'.$user['id'].'">
                    <button type="submit">Delete</button>
                </form>';
        echo '</td>';
        echo '</td>';
        echo '</tr>';
    }

    $db = new \application\core\Db();

    ?>
</table>
<br>
<br>
<br>
<?php
if(isset($_COOKIE['errors'])){
    $errors = unserialize($_COOKIE['errors']);
}
?>
<div style="border: 1px solid;padding: 5px;width: 15%;text-align: center">
    CREATE USERNAME
    <form method="post" action="/create_new_user" style="margin-top: 5px">
        <?php
        if(isset($errors)){
            foreach ($errors as $error){
                foreach ($error as $key => $item){
                    if($key == 'name'){
                        echo '<p style="color: red;margin: 0">' . $item . '</p>';
                    }
                }
            }
        }
        ?>
        <input type="text" name="name" placeholder="Name"><br><br>
        <?php
        if(isset($errors)){
            foreach ($errors as $error){
                foreach ($error as $key => $item){
                    if($key == 'email'){
                        echo '<p style="color: red;margin: 0">' . $item . '</p>';
                    }
                }
            }
        }
        ?>
        <input type="email" name="email" placeholder="Email"><br><br>
        <?php
        if(isset($errors)){
            foreach ($errors as $error){
                foreach ($error as $key => $item){
                    if($key == 'password'){
                        echo '<p style="color: red;margin: 0">' . $item . '</p>';
                    }
                }
            }
        }
        ?>
        <input type="password" name="password" placeholder="Password"><br><br>
        <button type="submit" style="margin-top: 5px">Create</button>
    </form>
</div>

<?php
    $db = new \application\core\Db();
    $selected = $db->selectWhere('users','id','3');
?>
<br>
<hr>
<p>Search</p>
<hr>
<table border="1">
    <tr>
        <th>#ID</th>
        <th>Name</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php
    foreach ($selected as $user) {
        echo '<tr>';
        echo '<td>' . $user['id'];
        echo '</td>';
        echo '<td>' . $user['name'];
        echo '</td>';
        echo '<td>';
        echo '<form action="/update_username" method="post">
                    <input type="text" name="name">
                    <input type="hidden" name="id" value="'.$user['id'].'">
                    <button type="submit">Update</button>
                </form>';
        echo '</td>';
        echo '<td>';
        echo '<form action="/delete_user" method="post">
                    <input type="hidden" name="id" value="'.$user['id'].'">
                    <button type="submit">Delete</button>
                </form>';
        echo '</td>';
        echo '</td>';
        echo '</tr>';
    }

    $db = new \application\core\Db();
    ?>
</table>


</body>
</html>