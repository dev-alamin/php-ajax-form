<?php include 'template/header.php'; ?>

<?php

$database = new mysqli('localhost', 'root', '', 'form');
$path = $_SERVER['PATH_INFO'];
$path = ltrim($path, "/");

if ($path) {
    $id = $path;

    $dsql = "SELECT * FROM data_sample WHERE url LIKE '%$id%'";
    $data = $database->query($dsql);

    if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="mb-5 mt-3">Record of <?php echo $row['name']; ?></h2>
                        <h4><strong>Name: </strong><?php echo $row['name']; ?></h4>
                        <p><strong>Email: </strong><?php echo $row['email']; ?></p>
                        <p><strong>Website: </strong><?php echo $row['website']; ?></p>
                        <p><strong>Gender: </strong><?php echo $row['gender']; ?></p>
                        <p><strong>Comment: </strong><?php echo $row['comment']; ?></p>
                    </div>
                </div>
            </div>
<?php }
    }
}