<?php
include "includes/header.php";
include "includes/db.php";

$slug = $_GET['slug'];

$stmt = $conn->prepare("SELECT * FROM services WHERE slug=?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$service = $stmt->get_result()->fetch_assoc();
?>

<main>

<div class="page-banner overlay">
    <div class="page-banner overlay">
        <div class="page-banner-content">
            <div class="container text-center">

                <!-- TITLE -->
                <h1 class="heading text-80 fw-700" data-aos="fade-up">
                    <?= htmlspecialchars($service['title']) ?>
                </h1>

                <!-- BREADCRUMB -->
                <ul class="breadcrumb list-unstyled"
                    data-aos="fade-up"
                    data-aos-delay="100">

                    <!-- HOME -->
                    <li>
                        <a href="<?= BASE_URL ?>" class="text text-18">
                            Home
                        </a>
                    </li>

                    <!-- ARROW -->
                    <li>
                        <svg width="8" height="12" viewBox="0 0 8 12" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z"
                            fill="currentColor"/>
                        </svg>
                    </li>

                    <!-- SERVICES PAGE -->
                    <li>
                        <a href="<?= BASE_URL ?>services" class="text text-18">
                            Services
                        </a>
                    </li>

                    <!-- ARROW -->
                    <li>
                        <svg width="8" height="12" viewBox="0 0 8 12" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z"
                            fill="currentColor"/>
                        </svg>
                    </li>

                    <!-- CURRENT SERVICE -->
                    <li>
                        <a class="text text-18 active">
                            <?= htmlspecialchars($service['title']) ?>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</div>

<div class="container mt-100 mb-100">

    <h2 class="heading text-32 mb-4">
        <?= htmlspecialchars($service['title']) ?>
    </h2>

    <ul class="text-lists list-unstyled">

    <?php
    $stmt = $conn->prepare("SELECT * FROM service_items WHERE service_id=?");
    $stmt->bind_param("i", $service['id']);
    $stmt->execute();
    $items = $stmt->get_result();

    while($item = mysqli_fetch_assoc($items)):
    ?>

    <li class="text-item text text-16 fw-500 mb-2">
        + <?= htmlspecialchars($item['title']) ?>
    </li>

    <?php endwhile; ?>

    </ul>

</div>

</main>

<?php include "includes/footer.php"; ?>