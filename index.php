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
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Z nami stać cię na lepsze auto</h1>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check"></i> Nasi doświadczeni, certyfikowani konsultanci finansowi zaoferują Państwu niezależną poradę finansową na podstawie pisemnej oferty finansowej od konkurencji</li>
                    <li><i class="fas fa-check"></i> Ocenią korzyści sfinansowania samochodu oraz innych usług</li>
                    <li><i class="fas fa-check"></i> Nasze usługi obejmują również kompleksową obsługę formalności związanych z zakupem, finansowaniem i ubezpieczeniem auta</li>
                    <li><i class="fas fa-check"></i> Zaufało nam już tysiące klientów, którzy skorzystali z naszych usług i cieszą się lepszymi samochodami</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h1>Zapłacimy gotówką za Twoje auto w każdym czasie.</h1>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check"></i> Tylko u nas otrzymasz najkorzystniejszą, rynkową wycenę skupu za swoje auto oraz pieniądze w gotówce</li>
                    <li><i class="fas fa-check"></i> Samochód przyjedziemy odkupić od Ciebie nawet z pod domu</li>
                    <li><i class="fas fa-check"></i> Działamy szybko i profesjonalnie, zapewniając pełne bezpieczeństwo i transparentność transakcji</li>
                    <li><i class="fas fa-check"></i> Jesteśmy liderem na rynku skupu samochodów i gwarantujemy uczciwe i sprawiedliwe warunki sprzedaży</li>
                </ul>
            </div>
        </div>
    </div>
<?php
include './footer.php';
