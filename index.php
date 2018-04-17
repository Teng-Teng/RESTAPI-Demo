<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rest API Client Side Demo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Rest API Client Side Demo</h2>
  <form class="form-inline" action="" method="POST">
    <div class="form-group">
      <label for="name">Name</label>
      <input id="input1" type="text" name="name" class="form-control"  placeholder="Enter Product Name" required/>
    </div>
    <button id="btn" type="submit" name="submit" class="btn btn-default">Submit</button>
  </form>
  <p>&nbsp;</p>
  <h3>
  <?php
    if(isset($_POST['submit']))
    {
      $name = $_POST['name'];

      $url = "http://localhost/API/api/" . $name;
      
      $client = curl_init($url);
      curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
      $response = curl_exec($client);
      
      $result = json_decode($response);
      
      echo $result->data; 
    }
   ?>
  </h3>
</div>
<div class="info"></div>

<!-- <script>
  $(document).ready(function(){
    $("#btn").click(function() {
        var name = $("#input1").val();
        $.ajax({
              // The URL for the request
              //url: "demo_get_post.php",
            url: "http://localhost/API/api.php",
              // The data to send (will be converted to a query string)
              data: {
                  name: name
              },
           
              // Whether this is a POST or GET request
              type: "GET",
           
              // The type of data we expect back
              dataType : "json",
              success : function(data, textStatus, jqXHR){
                $('.info').html(data.data);
                console.log(data);
              }
          })
          // Code to run if the request succeeds (is done);
          // The response is passed to the function
          
          // Code to run if the request fails; the raw request and
          // status codes are passed to the function
          .fail(function( xhr, status, errorThrown ) {
            alert( "Sorry, there was a problem!" );
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
          });
      })

  });
</script> -->
</body>


</html>