<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Aloha!</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

<img src="https://images.unsplash.com/photo-1638153867870-daadae81acb5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="" width="150"/>

 <?php echo $data->gambar_logo;?>

  
      <?php 
          echo htmlspecialchars_decode($data->visi_misi);
          echo htmlspecialchars_decode($data->sambutan);
          echo htmlspecialchars_decode($data->sejarah);
      ?>


</body>
</html>