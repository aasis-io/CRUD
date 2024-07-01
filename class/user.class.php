<?php

require_once('common.class.php');

class User extends Common
{
    public $id, $name, $email, $address,
        $phone, $password;

    public function save()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'crud');
        $sql = "insert into users(name, email, phone, address, password) values('$this->name','$this->email',
               '$this->phone', '$this->address', MD5('$this->password'))";

        $conn->query($sql);

        if ($conn->affected_rows == 1 && $conn->insert_id > 0) {
            // return $conn->insert_id;
            header('Location:dashboard/index.php?v=Registered Successfully');
        } else {
            header('Location:register.php?v="Error Occured!"');
            return false;
        }
    }

    public function login()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'crud');
        $encryptedPassword = md5($this->password);
        $sql = "select * from users where 
                 email='$this->email' and 
                 password='$encryptedPassword'";
        $var = $conn->query($sql);
        $data = $var->fetch_object();

        if ($data->email == $this->email || $data->password == $this->password) {

            if ($var->num_rows > 0) {
                @session_start();
                $_SESSION['id'] = $data->id;
                $_SESSION['name'] = $data->name;
                $_SESSION['email'] = $data->email;
                setcookie('email', $data->email, time() + 60 * 60);
                header('Location: dashboard/index.php?v=Logged In Successfully!&id=' . $data->id);
                // header('Location: dashboard/profile.php?v=Logged In Successfully!');
            } else {
                $error = "Error Occured!";
                return $error;
            }
        } else {
            $error = "Invalid Credentials!";
            return $error;
        }
    }
    public function edit()
    {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'crud');
        // Prepare the statement to prevent SQL injection
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $this->name, $this->email, $this->phone, $this->address, $this->id);

        // Execute the statement
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows === 1) {
            $result = $this->id;
        } else {
            $result = false;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        return $result;
    }

    public function delete()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'crud');
        $sql = "delete from users where id='$this->id'";
        $var = $conn->query($sql);
        if ($var) {
            return "success";
        } else {
            return "failed";
        }
    }

    public function getById()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'crud');
        $sql = "select * from users where id='$this->id'";
        $var = $conn->query($sql);
        if ($var->num_rows > 0) {
            $data = $var->fetch_object();
            return $data;
        } else {
            return [];
        }
    }
}
