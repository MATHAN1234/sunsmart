<!DOCTYPE html>
<html lang="en">

<?PHP include "include/head.php"?>

<body>
    
    <div class="page-wrapper">
        <?PHP include "include/header.php"?>

        <main class="main">
            <div class="page-header" style="background-image: url(images/page-header.jpg)">
                <h1 class="page-title">GET YOUR PERSONALIZED SUN PROTECTION PLAN</h1>
            </div>
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="index.php"><i class="d-icon-home"></i></a></li>
                        <li>Personalized Link</li>
                    </ul>
                </div>
            </nav>
            <div class="page-content mt-6">
                <div class="container">
                    <div class="row gutter-lg">
                        <div class="col-lg-9">
                            <div class="reply">
                                <div class="title-wrapper text-left">
                                    <h3 class="title title-simple text-left text-normal">
                                        Get Your Personalized Sun Protection Plan
                                    </h3>
                                    <p>Answer a few quick questions and get tailored sunscreen recommendations just for you.</p>
                                </div>
                                <form action="generate_plan.php" method="GET">
                                    <div class="row">
                                        <!-- Name -->
                                        <div class="col-md-6 mb-5">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name *" required />
                                        </div>
                                        <!-- Email -->
                                        <div class="col-md-6 mb-5">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email"/>
                                        </div>

                                        <!-- Location -->
                                        <div class="col-md-6 mb-5">
                                            <select class="form-control" id="location" name="location" onchange="updateCoordinates()" required>
                                                <option value="" data-lat="" data-lon="">-- Select City --</option>
                                                <option value="Sydney" data-lat="-33.8688" data-lon="151.2093">Sydney</option>
                                                <option value="Melbourne" data-lat="-37.8136" data-lon="144.9631">Melbourne</option>
                                                <option value="Brisbane" data-lat="-27.4698" data-lon="153.0251">Brisbane</option>
                                                <option value="Perth" data-lat="-31.9505" data-lon="115.8605">Perth</option>
                                                <option value="Adelaide" data-lat="-34.9285" data-lon="138.6007">Adelaide</option>
                                            </select>
                                            <input type="hidden" id="latitude" name="latitude">
                                            <input type="hidden" id="longitude" name="longitude">
                                        </div>

                                        <!-- Skin Type -->
                                        <div class="col-md-6 mb-5">
                                            <select class="form-control" id="skin_type" name="skin_type" required>
                                                <option value="" disabled selected>Select Your Skin Type *</option>
                                                <option value="Fair">Fair</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Dark">Dark</option>
                                                <option value="Sensitive">Sensitive</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Preferred Language -->
                                        <div class="col-md-6 mb-5">
                                            <select class="form-control" id="language" name="language" required>
                                                <option value="" disabled selected>Select Preferred Language *</option>
                                                <option value="English">English</option>
                                                <option value="Chinese">Chinese</option>
                                                <option value="Urdu">Urdu</option>
                                                <option value="Hindi">Hindi</option>
                                            </select>
                                            <input type="hidden" id="selected-language" name="language">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-md">
                                        GENERATE MY SUN PROTECTION PLAN <i class="d-icon-arrow-right"></i>
                                    </button>
                                </form>

                                <script>
                                    function updateCoordinates() {
                                        let locationSelect = document.getElementById("location");
                                        let selectedOption = locationSelect.options[locationSelect.selectedIndex];

                                        document.getElementById("latitude").value = selectedOption.getAttribute("data-lat");
                                        document.getElementById("longitude").value = selectedOption.getAttribute("data-lon");
                                    }

                                    document.getElementById("language").addEventListener("change", function() {
                                        document.getElementById("selected-language").value = this.value;
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?PHP include "include/footer.php"?>
    </div>

</body>
</html>
