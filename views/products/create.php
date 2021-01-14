
<div>
<h1>create product</h1>


    <!--Generate ERROR  -->
    <?php if (!empty($errors)):?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $each):?>
        <div><?php echo $each?></div>
        <?php endforeach;?>
    </div>
    <?php endif; ?>

<!-- Product INFO form-->
<form method="POST" enctype="multipart/form-data">

    <!--check image exist-->

    <div class="mb-3">

    <label >Product Image</label>   
    <br>

    <input type="file" name='image' >
    </div>
        
        
        <div class="mb-3">
            <label >Product Titile</label>
            <input type="text" name='title' class="form-control" value="<?php echo $products['title'] ?>">
        </div>

        <div class="mb-3">
            <label >Product Description</label>
            <textarea  class="form-control" name='description'><?php echo $products['desc'] ?></textarea>
        </div>

        <div class="mb-3">
            <label >Product Price</label>
            <input type="number" name='price' step=".01" class="form-control" value="<?php echo $products['price']?>">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>