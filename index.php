<?php include "function.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <h2>Product Lists</h2>
        <button class="btn btn-primary float-end me-5" data-bs-toggle="modal" data-bs-target="#exampleModal" id="add">Add Product</button>
        <table class="table text-center align-middle" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th>CODE</th>
                    <th>NAME</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>IMAGE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php getProduct() ?>
            </tbody>
        </table>
    </div>
     <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="edit_code" id="edit_code">
            <div class="form-group">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Price</label>
                <input type="text" name="price" id="price" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">QTY</label>
                <input type="text" name="qty" id="qty" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <input type="text" name="hide_img" id="hide_img">
            </div>
            <button type="button" class="btn btn-danger mt-3" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary mt-3 ms-2" name="save" id="btnSave">Save</button>
            <button type="submit" class="btn btn-success mt-3 ms-2" name="btnEdit" id="btnEdit">Edit</button>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- modal delete -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this product?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="hide_code" id="hide_code">
            <button type="submit" class="btn btn-primary mt-3 ms-2" name="btnDelete">Yes, delete.</button>
            <button type="button" class="btn btn-danger mt-3" data-bs-dismiss="modal">Cancel</button>
        </form>
      </div>
      
    </div>
  </div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
      $('#add').click(function(){
        $('#exampleModalLabel').text('Add product');
        $('#btnEdit').hide();
        $('#btnSave').show();
      })
        $(document).on("click",'#delete',function(){
            $id=$(this).attr('data-id');
            $('#hide_code').val($id)
        })
        $(document).on('click','#edit',function(){
          $('#exampleModalLabel').text('Edit Product');
          $('#btnSave').hide();
          $('#btnEdit').show();
          $editCode=$(this).attr('edit-id');
          $('#edit_code').val($editCode);
           $tr=$(this).parents('tr');
           $name=$tr.find('td').eq(1).text();
           $price=$tr.find('td').eq(2).text();
           $qty=$tr.find('td').eq(3).text();
           $image_name=$tr.find('img').attr('src').split('/').pop();
           
           //push data into form
           $('#name').val($name);
           $('#price').val($price);
           $('#qty').val($qty);
           $('#hide_img').val($image_name);
            
                
        })
    })
</script>
