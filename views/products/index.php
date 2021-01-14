


<h1>Product list</h1>
<a href="/products/create" class="btn btn-info">Create Product</a>


<form>
    <div class="input-group mb-3">
        <input type="text" class="form-control"
            placeholder="Search for products"
            name="search" value="<?php echo $search?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary"
                type="submit">search</button>
            </div>
    </div>
</form>



<table class="table">
<thead>
<tr>
  <th scope="col">#</th>
  <th scope="col">Image</th>
  <th scope="col">Title</th>
  <th scope="col">Price</th>
  <th scope="col">Release Date</th>
  <th scope="col">Action</th>

</tr>
</thead>
<tbody>
  <?php
  foreach ($products as $i=> $each):?>
    <tr>
    <th scope="row"><?php echo $i+1?></th>
    <td>
      <img src="<?php echo $each['image']?>" class="product-image">
    </td>
    <td><?php echo $each['title']?></td>
    <td><?php echo $each['price']?></td>
    <td><?php echo $each['create_date']?></td>
    <td>
    <a href="/products/edit?id=<?php echo $each['id']?>"  class="btn btn-warning">Edit</a>

    <form style="display: inline-block" method='post' action="/products/delete">
    <input type="hidden" name='id' value="<?php echo $each['id']?>">
    <button type='submit' class="btn btn-outline-danger">Delete</button>

    </form>

    </td>

    </tr>
 
  <?php endforeach;?>


</tbody>
</table>