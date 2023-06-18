<?php
include './header.php';
?>

<body class="home">
    <div id="slider" class="carousel slide mb-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slider" data-slide-to="0" class="active"></li>
            <li data-target="#slider" data-slide-to="1"></li>
            <li data-target="#slider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="aspect-ratio">
                    <img src="/assets/images/image1.jpg" class="d-block img-fluid" alt="Image 1">
                </div>
            </div>
            <div class="carousel-item">
                <div class="aspect-ratio">
                    <img src="/assets/images/image2.jpg" class="d-block img-fluid" alt="Image 2">
                </div>
            </div>
            <div class="carousel-item">
                <div class="aspect-ratio">
                    <img src="/assets/images/image3.jpg" class="d-block img-fluid" alt="Image 3">
                </div>
            </div>
        </div>
        <a class="carousel-control-prev ml-3" href="#slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next mr-3" href="#slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non metus eget dolor lobortis tincidunt
            vitae et lorem. Integer condimentum ipsum nec tellus fringilla, et fringilla lorem tincidunt. Aenean
            lobortis sem at consectetur viverra. Fusce sagittis nisl dolor, vel tincidunt risus efficitur id. Nullam
            aliquam mauris mi, et convallis felis gravida in.
        </p>
    </div>

<?php
include './footer.php';
