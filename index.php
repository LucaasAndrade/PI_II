<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        
        <title>Olá Mundo!</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


        <style>
            body{
                background-color: gray;
                color: white;

                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                /* text-align: center; */
                
                margin-top: 10%;


                font-family: 'times-romans';
            }
            .login{
                color: red;
            }

        </style>
        
    </head>
    <body>

        <form method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input 
                    type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="login" id="login"
                >
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input 
                    type="password" class="form-control" id="exampleInputPassword1"
                    name="senha" id="pass"
                    >
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php 
    
            $nome = $_POST["login"];
            $senha = $_POST["senha"];

            if(!$nome || !$senha){
                return;
            } else if($nome === "admin" && $senha === "1234"){
                echo "<p class=" . "login" . "> Passou </p>";
            } else{
                echo "<p class=" . "login" . "> Login ou Senha inválidos";
            }
 
        ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>