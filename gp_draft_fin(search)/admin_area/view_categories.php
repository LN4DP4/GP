<h3 class="text-center">categories</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-center">
            <th>slno</th>
            <th>category title</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary">
        <?php
        $select_cat = "SELECT * FROM categories";
        $result = mysqli_query($con, $select_cat);
        $number = 0;
        while($row = mysqli_fetch_assoc($result)){
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            $number++;
        ?>
        <tr class="text-center">
            <td><?php echo $number;?></td>
            <td><?php echo $category_title;?></td>
            <td><a href='index.php?edit_category=<?php echo $category_id ?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='index.php?delete_category=<?php echo $category_id  ?>'><i class='fa-solid fa-trash'></i></a></td> <!-- Added missing anchor tag closing -->
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
