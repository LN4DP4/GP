<h3 class="text-center">all users</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr>
            <th>sl no</th>
            <th>username</th>
            <th>user email</th>
            <th>user image</th>
            <th>user address</th>
            <th>user mobile</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody class='bg-secondary'>
        <?php
        $get_users = "SELECT * FROM user_table"; // Corrected query
        $result = mysqli_query($con, $get_users);
        $row_count = mysqli_num_rows($result);

        if ($row_count == 0) {
            echo "<tr><td colspan='7' class='text-center'>No users found</td></tr>"; // Display message when no users are found
        } else {
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $user_id = $row_data['user_id'];
                $username = $row_data['username'];
                $user_email = $row_data['user_email'];
                $user_image = $row_data['user_image'];
                $user_address = $row_data['user_address'];
                $user_mobile = $row_data['user_mobile'];
                $number++;
                echo "<tr>
                    <td>$number</td>
                    <td>$username</td>
                    <td>$user_email</td>
                    <td><img src='../users_area/user_images/$user_image' alt='$username' class='pod_img'/></td>
                    <td>$user_address</td>
                    <td>$user_mobile</td>
                    <td><a href='' class='text-center'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
            }
        }
        ?>
    </tbody>
</table>
