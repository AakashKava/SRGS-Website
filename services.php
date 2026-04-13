<?php
$page_title = "Services";
include "includes/header.php";
include "includes/db.php";
$services = mysqli_query($conn, "SELECT * FROM services ORDER BY id ASC");
?>

<!-- Main -->
<main>
    <!-- Page Banner -->
    <div class="page-banner overlay">
    <!-- <picture class="media media-bg">
        <source
        media="(max-width: 575px)"
        srcset="assets/img/banner/page-banner-575.jpg"
        />
        <source
        media="(max-width: 991px)"
        srcset="assets/img/banner/page-banner-991.jpg"
        />
        <img
        src="assets/img/banner/page-banner.jpg"
        width="1920"
        height="520"
        loading="eager"
        alt="Page Banner Image"
        />
    </picture> -->
    <div class="page-banner-content">
        <div class="container text-center">
        <h1 class="heading text-80 fw-700" data-aos="fade-up">
            Our Service
        </h1>
        <ul
            class="breadcrumb list-unstyled"
            data-aos="fade-up"
            data-aos-delay="100"
        >
            <li>
            <a
                href="index.php"
                class="text text-18"
                aria-label="Home Page"
            >
                Home
            </a>
            </li>
            <li>
            <svg
                width="8"
                height="12"
                viewBox="0 0 8 12"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z"
                fill="currentColor"
                />
            </svg>
            </li>
            <li>
            <a role="link" aria-disabled="true" class="text text-18 active">
                Our Service
            </a>
            </li>
        </ul>
        </div>
    </div>
    </div>

    <!-- Multicolmun -->
    <div class="multicolumn multicolumn-page mt-100 mb-100">
    <div class="container">
        <div class="multicolumn-inner">
        <div class="row product-grid">
            <?php while($service = mysqli_fetch_assoc($services)): ?>
            <div class="col-xl-4 col-md-6 col-12" data-aos="fade-up">
                <div class="multicolumn-card">
                    <h2 class="heading text-28">
                        <?= htmlspecialchars($service['title']) ?>
                    </h2>   
                
                <ul class="text-lists list-unstyled">
                    <?php
                        $stmt = $conn->prepare("SELECT * FROM service_items WHERE service_id=? LIMIT 2");
                        $stmt->bind_param("i", $service['id']);
                        $stmt->execute();
                        $items = $stmt->get_result();
                        while($item = mysqli_fetch_assoc($items)):
                    ?>
                    <li class="text-item text text-16 fw-500">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        >
                        <path
                            d="M18 13H13V18C13 18.2652 12.8946 18.5196 12.7071 18.7071C12.5196 18.8946 12.2652 19 12 19C11.7348 19 11.4804 18.8946 11.2929 18.7071C11.1054 18.5196 11 18.2652 11 18V13H6C5.73478 13 5.48043 12.8946 5.29289 12.7071C5.10536 12.5196 5 12.2652 5 12C5 11.7348 5.10536 11.4804 5.29289 11.2929C5.48043 11.1054 5.73478 11 6 11H11V6C11 5.73478 11.1054 5.48043 11.2929 5.29289C11.4804 5.10536 11.7348 5 12 5C12.2652 5 12.5196 5.10536 12.7071 5.29289C12.8946 5.48043 13 5.73478 13 6V11H18C18.2652 11 18.5196 11.1054 18.7071 11.2929C18.8946 11.4804 19 11.7348 19 12C19 12.2652 18.8946 12.5196 18.7071 12.7071C18.5196 12.8946 18.2652 13 18 13Z"
                            fill="CurrentColor"
                        />
                        </svg>
                        <?= htmlspecialchars($item['title']) ?>
                    </li>
                    <?php endwhile; ?>
                </ul>
                
                <a href="service/<?= $service['slug'] ?>" class="button button--primary border-white border-2 mt-3" aria-label="View more service" >
                View More
                <span class="svg-wrapper">
                    <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="CurrentColor" />
                    </svg>
                </span>
                </a>

                </div>
            </div>
            <?php endwhile; ?>
        </div>
        </div>
    </div>
    </div>
</main>

<?php 
include "includes/footer.php";
?>