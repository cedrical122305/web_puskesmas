<?php
    $username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
    $password = (isset($_POST['password'])) ? htmlentities($_POST['password']) : "";
    if(!empty($_POST['submit_validate'])){
        if ($username == "aldin@gmail.com" && $password == "12345"){
            header('location:../home');
        }   else{?>
                <script>
                    alert('Username atau Password yang anda masukkan tidak valid');
                    window.location='../login'
                </script>
<?php
    }
}
?>
