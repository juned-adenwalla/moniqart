<?php

$record_per_page = 10;
$page = '';
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $record_per_page;


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">




    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&family=Balsamiq+Sans&fa
        mily=Comfortaa&family=Montserrat&family=Poppins&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/frontend/css/style.css?v=<?php echo time(); ?>">

    <!-- Video Js -->
    <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />

    <title>All Courses Page</title>



</head>

<body>

    <?php include('templates/_header.php'); ?>



    <section class="container allcoursesContainer my-5">

        <div class=" px-lg-0 px-4 py-5">
            <h2 class="circleAndLine">
                Courses
            </h2>

            <p class="my-4 text-center fst-italic">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, culpa.
            </p>

            <form action="#" method="post" class="my-5">
                <h4>Filter By</h4>
                <select class="form-select" name="filter" aria-label="Default select example"
                    style="border-color: #b92929;box-shadow: none;" onchange="this.form.submit()" >
                    <option selected>select </option>
                    <option value="new">Latest Course</option>
                    <option value="old">Oldest Course</option>
                    <option value="highprice">Highest Price</option>
                    <option value="lowprice">Lowest Price</option>
                </select>
            </form>

            <div class="courses__cards m-0   row w-100 justify-content-start">

                <?php

                if (isset($_GET['search'])) {

                    $name = $_GET['course'];
                    _showMoreCourses($name, '', $record_per_page, $start_from);

                } else if (isset($_POST['filter'])) {


                    $filter = $_POST['filter'];
                    _showMoreCourses('', $filter, $record_per_page, $start_from);

                } else {
                    _showMoreCourses('', '', $record_per_page, $start_from);
                }



                ?>

            </div>

        </div>

        <div>
            <nav aria-label="...">
                <ul class="pagination pagination-lg">
                    <?php _getNoOfPagesForCourses($record_per_page, $page); ?>
                </ul>
            </nav>
        </div>

    </section>


    <?php include('templates/_footer.php'); ?>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

</body>

</html>