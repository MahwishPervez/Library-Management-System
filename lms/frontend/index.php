<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/5678c3e1ef.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="styles/utility.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" type="image/svg+xml" href="images/logo.svg">

    <title>Lexora - Your Library, Anytime, Anywhere.</title>
</head>

<body>
    <main>
        <section>
            <header>
                <div class="logo-container">
                    <img src="images/logo.svg" alt="">
                    <h1 class="logo">Lexora</h1>
                </div>
                <nav>
                    <ul>
                        <li><a href="#about-us">About Us</a></li>
                        <li><a href="#our-mission">Our Mission</a></li>
                        <li><a href="#contact-us">Contact Us</a></li>
                        <li><a href="login.php" class="login-btn">Login</a></li>
                    </ul>
                </nav>
            </header>

            <section class="hero">
                <div class="hero-content">
                    <h2>Welcome to Our Library - A World of Knowledge Awaits!</h2>
                    <p>Explore, Learn, and Grow with Every Page You Turn.</p>
                    <button>BROWSE CATALOG</button>
                </div>
                <div class="hero-image">
                    <img src="images/hero-img.jpg" alt="">
                </div>

            </section>
        </section>

        <section class="about-us" id="about-us">
            <div class="container">
                <div class="text-content">
                    <h2>About <span>Lexora</span></h2>
                    <p>Welcome to Lexora, an innovative Library Management System designed to simplify and enhance the way libraries operate. Whether you're a librarian, student, educator, or researcher, Lexora provides a streamlined, technology-driven solution to manage books, users, and digital content effortlessly.
                        <br/>
                        With a blend of modern features, intuitive design, and automation, Lexora is the perfect tool to make library management smoother, faster, and smarter!</p>
                </div>
                <div class="img-content">
                    <img src="images/about.jpg" alt="">
                </div>
            </div>
        </section>

        <section class="our-mission" id="our-mission">
            <div class="container">
                
                <div class="img-content">
                    <img src="images/mission.jpg" alt="">
                </div>
                <div class="text-content">
                    <h2>Our <span>Mission</span></h2>
                    <p>At Lexora, our mission is to redefine library management by integrating technology, accessibility, and efficiency. We aim to:
                        <p class="mission-pointers">
                            <span class="material-symbols-outlined">adjust</span>
                            Simplify book tracking and organization.
                        </p>

                        <p class="mission-pointers">
                            <span class="material-symbols-outlined">adjust</span>
                            Provide easy access to physical & digital resources.
                        </p>
                        <p class="mission-pointers">
                            <span class="material-symbols-outlined">adjust</span>
                            Enhance the library experience for students, teachers, and administrators.
                        </p>
                    </p>
                </div>
            </div>
        </section>


        <footer id="contact-us">
            <div id="contact-links">
                <div id="contact">
                    <div class="section-heading-container">
                        <h2 class="section-heading">CONTACT US</h2>
                    </div>
                    <form>
                        <input type="text" name="name" id="name" placeholder="Name">
                        <input type="text" name="email" id="email" placeholder="Email">
                        <textarea name="message" id="message" placeholder="Add a message"></textarea>
                        <input id="submit" type="submit" value="Submit">
                    </form>
                </div>
                <div id="quick-links">
                    <h2>QUICK LINKS</h2>
                    <div>
                        <a href="#about-us">ABOUT US</a>
                        <a href="#our-mission">OUR MISSION</a>
                        <a href="signup.php">SIGN UP</a>
                        <a href="login.php">LOGIN</a>
                    </div>
                </div>
            </div>
            <div id="socials">
                <div><i class="fa-brands fa-facebook-f"></i></div>
                <div><i class="fa-brands fa-linkedin-in"></i></div>
                <div><i class="fa-brands fa-youtube"></i></div>
            </div>
        </footer>

    </main>


</body>

</html>