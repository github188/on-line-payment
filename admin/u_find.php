<?php
include 'connection.php';
include 'checkStringSafety.php';
include 'check_login.php';
class User
{
    public $name;
    public $id;
    public $password;
    public $balance;
    public $telephone;
    public $email;
    public $real_name;
    public $sex;
    public $type;
    public $birthday;
}

if(check_login('2')){

$A_ID=$_GET["id"];
$A_NAME=$_GET["name"];
$A_TYPE=$_GET["type"];

if ($A_NAME == 'null') {
    $A_NAME = '';
}

if ($A_ID == 'null') {
    $A_ID = '';
}


if($A_TYPE=="seller") {
        $myConn = connection::getConn();

        $sql = "select * from seller where s_id like '$A_ID%'";

        $result = mysqli_query($myConn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $user = new User();
            $user->name = $row['username'];
            $user->pwd = $row['password'];
            $user->id = $row['s_id'];
            $user->sex = $row['sex'];
            $user->email = $row['email'];
            $user->real_name = $row['real_name'];
            $user->telephone = $row['telephone'];
            $user->balance = $row['balance'];
            $user->birthday = $row['birthday'];
            $user->type="seller";


            echo "<tr>";
            echo "<td>$user->id</td>";
            echo "<th>$user->name</td>";
            echo "<td>$user->pwd</td>";
            echo "<td>$user->balance</td>";
            echo "<td>$user->real_name</td>";
            echo "<td>$user->sex</td>";
            echo "<td>$user->birthday</td>";
            echo "<td>$user->telephone</td>";
            echo "<td>$user->email</td>";
            echo "<td>$user->type</td>";
            echo "<td></td>";
            echo "</tr>";
        }

        connection::freeConn();


}
else if($A_TYPE=="buyer"){

        $myConn = connection::getConn();

        $sql = "select * from buyer where b_id like '$A_ID%' and username like '$A_NAME%'";

        $result = mysqli_query($myConn, $sql);


        while ($row = mysqli_fetch_assoc($result)) {
            $user = new User();
            $user->name = $row['username'];
            $user->password = $row['password'];
            $user->id = $row['b_id'];
            $user->sex = $row['sex'];
            $user->email = $row['email'];
            $user->real_name = $row['real_name'];
            $user->telephone = $row['telephone'];
            $user->balance = $row['balance'];
            $user->birthday = $row['birthday'];
            $user->type="buyer";

            echo "<tr>";
            echo "<td>$user->id</td>";
            echo "<td>$user->name</td>";
            echo "<td>$user->password</td>";
            echo "<td>$user->balance</td>";
            echo "<td>$user->real_name</td>";
            echo "<td>$user->sex</td>";
            echo "<td>$user->birthday</td>";
            echo "<td>$user->telephone</td>";
            echo "<td>$user->email</td>";
            echo "<td>$user->type</td>";
            echo "<td></td>";
            echo "</tr>";
        }

        connection::freeConn();


}

else{
        $myConn = connection::getConn();

        $sql = "select * from seller where s_id like '$A_ID%' and username like '$A_NAME%'";

        $result = mysqli_query($myConn, $sql);


        while ($row = mysqli_fetch_assoc($result)) {
            $user = new User();
            $user->name = $row['username'];
            $user->password = $row['password'];
            $user->id = $row['s_id'];
            $user->sex = $row['sex'];
            $user->email = $row['email'];
            $user->real_name = $row['real_name'];
            $user->telephone = $row['telephone'];
            $user->balance = $row['balance'];
            $user->birthday = $row['birthday'];
            $user->type="seller";

            echo "<tr>";
            echo "<td>$user->id</td>";
            echo "<td>$user->name</td>";
            echo "<td>$user->password</td>";
            echo "<td>$user->balance</td>";
            echo "<td>$user->real_name</td>";
            echo "<td>$user->sex</td>";
            echo "<td>$user->birthday</td>";
            echo "<td>$user->telephone</td>";
            echo "<td>$user->email</td>";
            echo "<td>$user->type</td>";
            echo "<td></td>";
            echo "</tr>";
        }

        $sql = "select * from buyer where b_id like '$A_ID%' and username like '$A_NAME%'";

        $result = mysqli_query($myConn, $sql);


        while ($row = mysqli_fetch_assoc($result)) {
            $user = new User();
            $user->name = $row['username'];
            $user->password = $row['password'];
            $user->id = $row['b_id'];
            $user->sex = $row['sex'];
            $user->email = $row['email'];
            $user->real_name = $row['real_name'];
            $user->telephone = $row['telephone'];
            $user->balance = $row['balance'];
            $user->birthday = $row['birthday'];
            $user->type="buyer";

            echo "<tr>";
            echo "<td>$user->id</td>";
            echo "<td>$user->name</td>";
            echo "<td>$user->password</td>";
            echo "<td>$user->balance</td>";
            echo "<td>$user->real_name</td>";
            echo "<td>$user->sex</td>";
            echo "<td>$user->birthday</td>";
            echo "<td>$user->telephone</td>";
            echo "<td>$user->email</td>";
            echo "<td>$user->type</td>";
            echo "<td></td>";
            echo "</tr>";
        }


        connection::freeConn();

}}else
    echo "you have no authorization";

?>