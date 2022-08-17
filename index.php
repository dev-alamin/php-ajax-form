<?php include 'template/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mb-5 mt-3">PHP & MySQL Ajax Form Submit</h2>
            <table class="table mb-3">
                <thead>
                    <th> <span class="highlight">Serial</span> No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Comment</th>
                    <th>Gender</th>
                    <th>Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $database = new mysqli('localhost', 'root', '', 'form');

                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        $dsql = "DELETE FROM data_sample WHERE id = '$id'";
                        $deleted = $database->query($dsql);

                        if ($deleted) {
                            echo '<script>window.location="http://localhost/forms"</script>';
                        }
                    }

                    $select_sql = "SELECT * FROM data_sample ORDER BY id DESC LIMIT 10";
                    $show_data = $database->query($select_sql);
                    $sn = 1;
                    if ($show_data->num_rows > 0) :
                        while ($row = $show_data->fetch_assoc()) :
                    ?>
                            <tr>
                                <td class="dname"><?php echo $sn++; ?></td>
                                <td class="dname"><?php echo $row['name'] ?></td>
                                <td class="demail"><?php echo $row['email'] ?></td>
                                <td class="dwebsite"><?php echo $row['website'] ?></td>
                                <td class="dcomment"><?php echo $row['comment'] ?></td>
                                <td class="dgender"><?php echo $row['gender'] ?></td>
                                <td class="ddate"><?php echo date('g:i a - d-M-Y', strtotime($row['date'])); ?></td>
                                <td class="ddate"><a onclick="return confirm('Are you sure to delete this record?')" href="index.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                                <td class="ddate"><a href="comment.php/<?php echo $row['url']; ?>">Open</a></td>
                            </tr>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </tbody>
            </table>
            <div class="success-container">

            </div>
            <form class="form" id="ourform">
                <input name="url" type="hidden" id="url" class="form-input form-control">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" id="name" class="form-input form-control">
                    <span class="name-error text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" id="email" class="form-input form-control">
                    <span class="email-error text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input name="website" type="text" id="website" class="form-input form-control">
                    <span class="website-error text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-input form-control"></textarea>
                    <span class="comment-error text-danger"></span>
                </div>
                <div class="form-group">
                    <select name="gender" id="gender" class="form-input form-control">
                        <option disabled selected value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <span class="gender-error text-danger"></span>
                </div>
                <!-- <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control form-input">
                </div> -->
                <div class="form-group">
                    <button name="submit" type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script src="script.js"></script>
</body>

</html>