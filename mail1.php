<?php

        error_reporting(~E_WARNING & ~E_NOTICE);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];  
        $resume=$_FILES['resume'];    
           
        $error=false;
        // $errormessage = array();
        $errmsg = "";

        if($name == "" ){
            // $errormessage[0] = "Name is empty";
            $errmsg = "Name is empty";
            $error = true;
        }
        if($email == ""){
            // $errormessage[1] = "Email is empty";
            $errmsg = $errmsg . "<br>Email is empty";
            $error = true;
        }
        if($subject == ""){
            // $errormessage[2] = "Subject is empty";
            $errmsg = $errmsg . "<br>Subject is empty";
            $error = true;
        }
        if($message == ""){
            // $errormessage[3] = "Message is empty";
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
                            
                            $target_dir = "resumes/";
                            $target_file = $target_dir . basename($_FILES["resume"]["name"]);
                            $uploadOk = 1;
                            //$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                            
                           
                            if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
                                // echo "The file ". htmlspecialchars( basename( $_FILES["resume"]["name"])). " has been uploaded.";
                              } else {
                                echo "Sorry, there was an error uploading your file.";
                              }
                    



                        $sql = "INSERT INTO `contact` (`id`,`name`, `email`, `subject`,`message`,`resume`)
                        VALUES (NULL,'$name', '$email', '$subject','$message','$target_file')";
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