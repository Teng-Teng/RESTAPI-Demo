<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rest API Client Side Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
        .active{
            display: inline-block;
        }
        .hidden{
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Rest API Client Side Demo</h2>

    <form class="form-inline" action="" method="POST">
        <div><a id="select_c" href="#">Select</a>|<a id="insert_c" href="#">Insert</a>|<a id="update_c" href="#">Update</a>|<a id="delete_c" href="#">Delete</a></div>
        <div>
            <div class="select active">
                <label for="">Product ID:</label>
                <input type="text" name="sel_id" class="form-control"><br>
                <button id="select" class="btn btn-default" name="submit" value="select" disabled>Select</button>
            </div>
            
            <div class="insert hidden">
                <label for="">Product Name:</label> 
                <input type="text" name="ins_name" class="form-control"><br>
                <label for="">Product Quantity:</label>  
                <input type="text" name="ins_quantity" class="form-control"><br>
                <button id="insert" class="btn btn-default" name="submit" value="insert">Insert</button>
            </div>
            
            <div class="update hidden">
                <label for="">Product ID:</label>  
                <input type="text" name="upd_id" class="form-control"><br>
                <label for="">Price From&nbsp;</label>
                <input type="number" name="upd_orign" class="form-control">
                <label for="">&nbsp;to&nbsp;</label>
                <input type="number" name="upd_cur" class="form-control"><br>
                <button id="update" class="btn btn-default" name="submit" value="update">Update</button>
            </div>
            
            <div class="delete hidden">
                <label for="">Product ID:</label>
                <input type="text" name="del_id" class="form-control"><br>
                <button id="delete" class="btn btn-default" name="submit" value="delete">Delete</button>
            </div>
        </div>
    </form>
    <h3>
    <?php
    if(isset($_POST['submit'])) {
        if($_POST['submit'] == 'select') {
            $id = $_POST['sel_id'];

            $url = "http://localhost/Exercise/RESTAPI-Demo/api/select/" . $id;

            $client = curl_init($url);
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);

            $result = json_decode($response);

            echo $result->data;
        } else if($_POST['submit'] == 'insert') {
            $name = $_POST['ins_name'];
            $quantity = $_POST['ins_quantity'];

            $url = "http://localhost/Exercise/RESTAPI-Demo/api/insert/" . $name . "/" . $quantity;

            $client = curl_init($url);
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);

            $result = json_decode($response);

            echo $result->data;
        } else if($_POST['submit'] == 'update') {
            $id = $_POST['upd_id'];
            $cur = $_POST['upd_cur'];

            $url = "http://localhost/Exercise/RESTAPI-Demo/api/update" . $id . "/" . $cur;

            $client = curl_init($url);
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);

            $result = json_decode($response);

            echo $result->data;
        } else if($_POST['submit'] == 'delete') {
            $id = $_POST['del_id'];

            $url = "http://localhost/Exercise/RESTAPI-Demo/api/delete" . $id;

            $client = curl_init($url);
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);

            $result = json_decode($response);

            echo $result->data;
        } else {
            echo 'lalala rose';
        }
    }
    ?>
    </h3>
</div>
<div class="info"></div>

<script>
    $(document).ready(function(){
        $('a').click(function(){
            var para = $(this).attr('id').substr(0,6);
            $('.'+para).removeClass('hidden').addClass('active').siblings().removeClass('active').addClass('hidden');
        });

        $('input').change(function(){
            //disable select button when input is not filled.
            if($("input[name='sel_p_id']").val()!=""){
                $(".select button").attr('disabled',false);
            }else{
                $(".select button").attr('disabled',true);
            }

        });

    });
</script>

</body>
</html>