<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/theme.css">
    <style>
        .corpo{
            padding:2px 10px 4px 0px;
            color:#fff;
            text-align:center;
        }
        body{
            margin:0px;
            padding:0pX;
           
        }
        .container{
            padding:16px;     
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API REST</title>
</head>
<body>
    <div class="corpo alert alert-success">
       <h1 class="">Pagina Pricipal Da Filial</h1>
    </div>      
    <div class="container">
        <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Preço</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  
                        $url = "http://localhost/apiRest/api/v1/estoque/mostrar";
                        $file = file_get_contents($url);
                        $decode = json_decode($file, true);
                        if($decode["status"] != "erro"){
                        foreach($decode['dados'] as $produtos){?>
                        <tr>
                            <td scope="row"><?php echo $produtos['id'];?></td>
                            <td><?php echo $produtos['nome'];?></td>
                            <td><?php echo $produtos['preco'];?></td>
                        </tr>
                    <?php }
                   }else{
                    echo '<div class="alert alert-danger" role="alert">
                        <strong>'.json_encode($decode['dados']).'</strong>
                    </div>';
                   }?>
                  </tbody>
        </table>
        <div class="alert alert-info" role="alert">
            <strong><?php echo $decode['status'];?></strong>
        </div>
    </div>      
</body>
</html>