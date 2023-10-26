<hr class="my-3">
<footer class="pt-5">
    <div class="row">
        <div class="col-6 col-md-4 mb-3" data-aos="fade-down" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
            <h5>Our vision</h5>
            <p>eGrocery's vision is to redefine grocery shopping, making it convenient, sustainable, and community-driven. We're committed to quality, accessibility, and a greener future, simplifying the way you shop for everyday essentials</p>
        </div>

        <div class="col-6 offset-md-1 col-md-2 mb-3" data-aos="fade-down" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
            <h5>Section</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="./Home.php" class="nav-link p-0 text-muted">Home</a></li>
                <li class="nav-item mb-2"><a href="Home.php#aboutus" class="nav-link p-0 text-muted">About us</a></li>
                <li class="nav-item mb-2"><a href="Home.php#contactus" class="nav-link p-0 text-muted">Contact us</a></li>
            </ul>
        </div>

        <div class="col-md-5 mb-3" data-aos="fade-down" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
            <form>
                <h5>Stay in the loop with eGrocery !</h5>
                <p>Subscribe to our newsletter for a monthly digest of the freshest groceries, special offers, and exciting new arrivals</p>
                <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                    <label for="newsletter1" class="visually-hidden">Email address</label>
                    <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                    <button class="btn btn-primary" type="button">Subscribe</button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between py-2 my-5 border-top" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
        <ul class="list-unstyled d-flex">
            <li class="ms-3"><a class="link-dark" href="#">Facebook</a></li>
            <li class="ms-3"><a class="link-dark" href="#">Instergram</a></li>
        </ul>
        <p>&copy; 2023 e-grocery. All rights reserved.</p>

    </div>
</footer>
</div>
</div>

<?php require '../process/processJs.inc.php'?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../src/js/script.js"></script>
<script src="../src/js/aos/aos.js"></script>
<script>
    AOS.init();
    window.onload = () => {cartitems()}
</script>

</body>

</html>