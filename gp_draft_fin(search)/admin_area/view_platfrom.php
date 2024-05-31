<h3 class="text-center">platfroms</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-center">
            <th>slno</th>
            <th>platfrom title</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary">
        <?php
        $select_cat = "SELECT * FROM platfrom";
        $result = mysqli_query($con, $select_cat);
        $number = 0;
        while($row = mysqli_fetch_assoc($result)){
            $platfrom_id = $row['platfrom_id'];
            $platfrom_title = $row['platfrom_title'];
            $number++;
        ?>
        <tr class="text-center">
            <td><?php echo $number;?></td>
            <td><?php echo $platfrom_title;?></td>
            <td><a href='index.php?edit_platfrom=<?php  echo $platfrom_id  ?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='index.php?delete_platfrom=<?php  echo $platfrom_id  ?>'><i class='fa-solid fa-trash'></i></a></td> <!-- Added missing anchor tag closing -->
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>