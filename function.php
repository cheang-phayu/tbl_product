<?php 
    $connection= new mysqli("localhost","root","","db_12_1",3308);
    // if($connection){
    //     echo "Success.";
    // }else{
    //     echo "Error";
    // }
    function moveFile($name){
        $image=rand(1,1000).'_'.$_FILES[$name]['name'];
        $tmp_name=$_FILES[$name]['tmp_name'];
        $path="./Image/".$image;
        move_uploaded_file($tmp_name,$path);
        return $image;
    }
    function insertProduct(){
        if(isset($_POST['save'])){
            $name=$_POST['name'];
            $price=$_POST['price'];
            $qty=$_POST['qty'];
            $image=moveFile('image');
            $sql="INSERT INTO `tbl_product`(`name`, `price`, `qty`, `image`) 
            VALUES ('$name','$price','$qty','$image')";
            global $connection;
            $connection->query($sql);
        }
    }
    insertProduct();
    function getProduct(){
        global $connection;
        $sql="SELECT * FROM `tbl_product` ORDER BY `code` DESC";
        $result=$connection->query($sql);
        while($row=$result->fetch_assoc()){
            echo '
                <tr>
                    <td>'.$row['code'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['price'].'</td>
                    <td>'.$row['qty'].'</td>
                    <td><img width="80px" src="./Image/'.$row['image'].'" alt=""></td>
                    <td>
                        <button class="btn btn-success me-2" edit-id="'.$row['code'].'" id="edit" data-bs-toggle="modal"  data-bs-target="#exampleModal">Edit</button>
                        <button class="btn btn-danger" data-id="'.$row['code'].'" id="delete" data-bs-toggle="modal" data-bs-target="#exampleModal1">Delete</button>
                    </td>
                </tr>
            ';
        }
    }
    function deleteProduct(){
        if(isset($_POST['btnDelete'])){
            $hide_code=$_POST['hide_code'];
            $delete="DELETE FROM `tbl_product` WHERE `code` ='$hide_code'";
            global $connection;
            $result=$connection->query($delete);
            if($result==TRUE){
                echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Deleted!",
                        icon: "success"
                    })
                });
            </script>';
            }
        }
    }
    deleteProduct();
    function editproduct(){
        date_default_timezone_set('Asia/Phnom_Penh');
        if(isset($_POST['btnEdit'])){
            $code=$_POST['edit_code'];
            $name=$_POST['name'];
            $price=$_POST['price'];
            $qty=$_POST['qty'];
            $image=$_FILES['image']['name'];
            $update_at=date('ymdhis');
            global $connection;
            if(empty($image)){
                $hide_img=$_POST['hide_img'];
                $sql="UPDATE `tbl_product` SET `name`='$name',`price`='$price',`qty`='$qty',`image`='$hide_img',`update_at`='$update_at' WHERE `code`='$code'";
            }else{
                $img=moveFile('image');
                $sql="UPDATE `tbl_product` SET `name`='$name',`price`='$price',`qty`='$qty',`image`='$img',`update_at`='$update_at' WHERE `code`='$code'";
            }
            $connection->query($sql);
        }
    }
    editproduct();
?>