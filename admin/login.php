<?php
session_start();
include __DIR__ . '/../includes/db.php';

// LOGIN LOGIC
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin'] = $user['id'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "User not found";
    }
}

// USE MAIN HEADER (THIS FIXES FONT ISSUE)
$page_title = "Admin Login";
?>
<!doctype html>
<html lang="en" class="no-js">
  <head>
    <title>SHRI RAM GEO SOLUTION</title>
    <link
      rel="shortcut icon"
      href="../assets/img/srgs-favicon.png"
      type="image/x-icon"
    />

    <!-- meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- all css -->
    <link rel="stylesheet" href="../assets/css/vendor.css" />
    <style>
      :root {
        /* Typography */
        --font-body--family: "Inter", sans-serif;
        --font-body--style: normal;
        --font-body--weight: 400;

        --font-heading--family: "Poppins", sans-serif;
        --font-heading--style: normal;
        --font-heading--weight: 600;

        --font-button--family: "Poppins", sans-serif;
        --font-button--style: normal;
        --font-button--weight: 600;

        /* h1-h6 */
        --font-h1--size: 60px;
        --font-h2--size: 48px;
        --font-h3--size: 36px;
        --font-h4--size: 24px;
        --font-h5--size: 20px;
        --font-h6--size: 16px;

        /* header nav */
        --font-nav-main: 16px;

        /* Colors */
        --color-background: rgba(255, 255, 255, 1);
        --color-foreground: rgba(28, 37, 57, 1);
        --color-foreground-heading: rgba(28, 37, 57, 1);
        --color-foreground-subheading: rgba(93, 102, 111, 1);
        --color-background-subheading: rgba(255, 255, 255, 0.1);
        --color-border-subheading-bg: rgba(32, 40, 45, 0.1);
        --color-primary: rgba(28, 37, 57, 1);
        --color-primary-background: rgba(28, 37, 57, 1);
        --color-primary-hover: rgba(28, 37, 57, 1);
        --color-primary-background-hover: rgba(28, 37, 57, 1);
        --color-border: rgba(255, 255, 255, 0.2);
        --color-border-hover: rgba(93, 102, 111, 0.5);
        --color-shadow: rgba(0, 0, 0, 1);
        --color-overlay: rgba(28, 37, 57, 0.6);

        /* Buttons */
        --font-button-size: 16px;
        --font-button-size-mobile: 16px;
        --style-button-height: 56px;
        --style-button-height-mobile: 48px;
        --style-button-slim-height: 52px;
        --style-button-slim-height-mobile: 40px;
        --style-cta-underline-offset: 5px;
        --style-cta-underline-thickness: 1px;

        /* Colors - Primary Button */
        --color-primary-button-text: rgba(255, 255, 255, 1);
        --color-primary-button-background: rgba(32, 40, 45, 1);
        --color-primary-button-border: rgba(32, 40, 45, 1);
        --color-primary-button-icon: rgba(28, 37, 57, 1);
        --color-primary-button-icon-background: rgba(255, 255, 255, 1);

        --color-primary-button-hover-text: rgba(32, 40, 45, 1);
        --color-primary-button-hover-background: rgb(255, 255, 255, 1);
        --color-primary-button-hover-border: rgb(32, 40, 45, 1);
        --color-primary-button-hover-icon: rgba(255, 255, 255, 1);
        --color-primary-button-hover-icon-background: rgba(28, 37, 57, 1);

        /* Colors - Secondary Button */
        --color-secondary-button-text: rgba(32, 40, 45, 1);
        --color-secondary-button-background: rgba(255, 255, 255, 1);
        --color-secondary-button-border: rgba(255, 255, 255, 1);
        --color-secondary-button-icon: rgba(255, 255, 255, 1);
        --color-secondary-button-icon-background: rgba(32, 40, 45, 1);

        --color-secondary-button-hover-text: rgba(255, 255, 255, 1);
        --color-secondary-button-hover-background: rgba(32, 40, 45, 1);
        --color-secondary-button-hover-border: rgba(32, 40, 45, 1);
        --color-secondary-button-hover-icon: rgba(28, 37, 57, 1);
        --color-secondary-button-hover-icon-background: rgba(255, 255, 255, 1);

        /* Colors - Input */
        --color-input-background: rgba(255, 255, 255, 1);
        --color-input-text: rgba(93, 102, 111, 1);
        --color-input-border: rgba(93, 102, 111, 0.2);
        --color-input-hover-background: rgba(255, 255, 255, 1);
        --color-input-hover-text: rgba(93, 102, 111, 1);
        --color-input-hover-border: rgba(93, 102, 111, 0.2);

        /* Borders */
        --style-border-width-buttons-primary: 1px;
        --style-border-width-buttons-secondary: 1px;
        --style-border-radius-buttons-primary: 40px;
        --style-border-radius-buttons-secondary: 40px;

        --style-border-width-inputs: 1px;
        --style-border-radius-inputs: 8px;
        --style-border-width: 1px;

        /* Focus */
        --focus-outline-width: 1px;
        --focus-outline-offset: 3px;

        /* Pagination */
        --style-pagination-border-width: 1px;
        --pagination-item-foreground: rgba(28, 37, 57, 1);
        --pagination-item-background: rgba(242, 242, 242, 1);
        --pagination-item-border: rgba(242, 242, 242, 1);
        --pagination-item-active-foreground: rgba(255, 255, 255, 1);
        --pagination-item-active-background: rgba(28, 37, 57, 1);
        --pagination-item-active-border: rgba(28, 37, 57, 1);

        /* Swiper */
        --swiper-navigation-size: 14px;
        --swiper-navigation-color: rgba(28, 37, 57, 1);
        --swiper-navigation-background-color: rgba(242, 242, 242, 1);
        --swiper-navigation-hover-color: rgba(28, 37, 57, 1);
        --swiper-navigation-hover-background-color: transparent;
        --swiper-pagination-bullet-inactive-color: rgba(242, 242, 242);
        --swiper-pagination-color: rgba(28, 37, 57, 1);
        --swiper-pagination-bullet-inactive-opacity: 1;
      }

      @media (max-width: 767px) {
        :root {
          --font-h1--size: 48px;
          --font-h2--size: 40px;
          --font-h3--size: 28px;
          --font-h4--size: 20px;
          --font-h5--size: 18px;
          --swiper-navigation-size: 12px;
        }
      }
    </style>
    <link rel="stylesheet" href="../assets/css/style.css" />
  </head>

  <body>
<main>

    <!-- Page Banner (Same as Contact Page) -->
    <!-- <div class="page-banner overlay">
        <div class="page-banner-content">
            <div class="container text-center">
                <h1 class="heading text-80 fw-700">
                    SRGS Admin
                </h1>
                <p class="text text-18">SHRI RAM GEO SOLUTION</p>
            </div>
        </div>
    </div> -->

    <!-- Login Section (Styled like Contact Form) -->
    <div class="section-contact-form section-padding" style="background: linear-gradient(184.15deg,rgba(28, 37, 57, 0) -187.51%,#1c2539 96.62%)">
        <div class="container d-flex justify-content-center">
            <div class="contact-box radius18">
                <div class="row product-grid justify-content-between">
                    <div class="col-12 col-lg-12 col-contact-form">
                        <div class="contact-form-wrap radius18">
                        
                        <div class="contact-form-headings">
                            <h2 class="heading text-32" data-aos="fade-up">
                            SHRI RAM GEO SOLUTION
                            </h2>
                            <p class="text text-16" data-aos="fade-up">
                            Admin Login
                            </p>
                        </div>
                        
                        <?php if(isset($error)): ?>
                            <p style="color:red; text-align:center;">
                                <?= $error ?>
                            </p>
                        <?php endif; ?>

                        <form method="POST" class="form contact-form" data-aos="fade-up">
                            <div class="field">
                            <input
                                type="text"
                                name="username"
                                class="text text-16"
                                placeholder="Username"
                                required
                            >
                            </div>

                            <div class="field">
                            <input
                                type="password"
                                name="password"
                                class="text text-16"
                                placeholder="Password"
                                required
                            >
                            </div>

                            <div class="form-button">
                            <button
                                type="submit"
                                class="button button--secondary"
                                aria-label="Send Message"
                            >
                                Login
                                <span class="svg-wrapper">
                                <svg
                                    class="icon-20"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                    d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z"
                                    fill="currentColor"
                                    ></path>
                                </svg>
                                </span>
                            </button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>
<script src="../assets/js/vendor.js" defer></script>
    <script src="../assets/js/main.js" defer></script>
  </body>
</html>