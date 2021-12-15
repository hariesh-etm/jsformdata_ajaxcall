<?php

$json = file_get_contents('php://input');
$data = json_decode($json);


    
        $name = $data->name;
        $email = $data->email;
        $subject = $data->subject;
        $message = $data->message;
        
        $error=false;
        $errormessage = array();
        $errmsg = "";

        if($name == "" ){
            $errormessage[0] = "Name is empty";
            $errmsg = "Name is empty";
            $error = true;
        }
        if($email == ""){
            $errormessage[1] = "Email is empty";
            $errmsg = $errmsg . "<br>Email is empty";
            $error = true;
        }
        if($subject == ""){
            $errormessage[2] = "Subject is empty";
            $errmsg = $errmsg . "<br>Subject is empty";
            $error = true;
        }
        if($message == ""){
            $errormessage[3] = "Message is empty";
            $errmsg = $errmsg . "<br>Message is empty";
            $error = true;
        }

        if($error){
            $data = array(
                'status' => 'failed',
                'message' => $errmsg
            );
        }else{
                //insertion();
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "theme-one";
        
                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                // Check connection
                if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }
        
                if ($name == "" || $email == "" || $subject =="" || $message == "" ){
                    $data = array(
                        'status' => 'failed',
                        'message' => "Error: " . $sql . "<br>" . mysqli_error($conn)
                    );
                            }
                        else{
                        $sql = "INSERT INTO `contact` (`id`,`name`, `email`, `subject`,`message`)
                        VALUES (NULL,'$name', '$email', '$subject','$message')";
                            }
                             if (mysqli_query($conn, $sql)) { 
                                 $data = array(
                        'status' => 'success',
                        'message' => 'successfully inserted'
                        );
                             //echo "Thank you for the responce, We will contact you soon";
                                } else {
                                    $data = array(
                                        'status' => 'failed',
                                        'message' => "Error: " . $sql . "<br>" . mysqli_error($conn)
                                    );
                         //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                 }
                        mysqli_close($conn);
                       
            }
    $result = json_encode(array("data" => $data));
    echo $result;

    function insertion()
    {
       

    }
?>