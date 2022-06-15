<?php
    //Get Parameter
    $roomname = $_GET["roomname"];

    //Connecting tothe database
    include 'db_connect.php';

    //Execute sql to check whether room exists
    $sql = "SELECT * FROM `rooms` WHERE roomname='$roomname'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            $message = 'This room does not exist. Try creating a new one.';
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/ChatApplication";';
            echo '</script>';
        }
    } else {
        echo "Error: ". mysqli_error($conn);
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!-- Custom styles for this template -->
  <link href="css/product.css" rel="stylesheet">

<style>

  h2, .container {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 10px;
    margin: 0 auto;
    max-width: 800px;
  }

  .innercontainer::after {
    content: "";
    clear: both;
    display: table;
  }

  .innercontainer {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 12px;
    margin: 5px 10px;
  }

  .time-right {
    float: right;
    color: #aaa;
  }

  .anyClass {
      height: 350px;
      overflow-y: scroll;
  }

  .inputdiv {
    max-width: 800px;
    margin: 15px auto;
  }

  @media (max-width: 800px) {
    section {
      margin: 15px 20px;
    }
  }
</style>
</head>

<body>
  <header class="site-header sticky-top py-1">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand text-white" href="#">MyAnonymousChat</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
  </header>

  <section>
    <h2 class="my-3">Chat Messages - <?php echo $roomname ?></h2>

    <div class="container">
        <div class="anyClass"></div>
        </div>
    </div>

    <div class="inputdiv">
      <input class="form-control my-2" type="text" placeholder="Add Message" name="usermsg" id="usermsg">
      <button class="btn btn-primary mb-3" name="submitmsg" id="submitmsg">Send</button>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script type="text/javascript">

    setInterval(runFunction, 1000);
    function runFunction() {
      $.post("htcont.php", {room: '<?php echo $roomname ?>'}, function(data, status) {
        document.getElementsByClassName('anyClass')[0].innerHTML = data;
      });
    }

    var input = document.getElementById("usermsg");
    input.addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("submitmsg").click();
      }
    });

    $("#submitmsg").click(function(){
      var clientmsg = $("#usermsg").val();
      $.post("postmsg.php", {text: clientmsg, room: '<?php echo $roomname ?>', ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'}, function(data, status){
        document.getElementsByClassName('anyClass')[0].innerHTML = data;
      });
      $("#usermsg").val("");
      return false;
    });
  
  </script>

</body>
</html>
