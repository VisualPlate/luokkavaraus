<!--NAVBAR TO LOGGED IN USERS-->
<div class="pos-top pos-right mrg-15 tab-hidden">
    <div class="user-navbar row space-between">
        <div class="row">
            <div>
                <img src=".assets/icons/user-placeholder.svg" style="height:100%">
            </div>
            <div class="col col-cent">
                <div>
                    <p class="text-primary text-user-navbar-header"><?= $_SESSION["email"]; ?></p>
                </div>
            </div>
        </div>
        <div>
            <img src="assets/icons/burger-menu-green.svg" style="height:100%" id="userBurgerMenu">
        </div>
    </div>
    <div class="mrg-10"></div>
    <div class="user-navbar-open space-between col" id="userDropdown">
        <div class="row space-between mrg-in-10">
            <a href="pages/reservations.php" class="text-primary text-user-navbar-secondary" style="display:flex;align-self:center">Omat varaukset</a>
            <img src="assets/icons/navbar-menu-list.svg" style="height:24px;isplay:flex;align-self:center">
        </div>
        <div class="mrg-5"></div>
        <div class="row space-between mrg-in-10">
            <a href="pages/logout.php" class="text-primary text-user-navbar-secondary" style="display:flex;align-self:center">Kirjaudu ulos</a>
            <img src="assets/icons/navbar-door-open-red.svg" style="height:24px;isplay:flex;align-self:center">
        </div>
    </div>
</div>
<!--MOBILE NAVBAR-->
<div class="mob-user-navbar tab-show">
    <div class="row space-between">
        <div class="row">
            <div>
                <img src="assets/icons/user-placeholder.svg" style="height:36px">
            </div>
            <div class="col col-cent">
                <div>
                    <p class="text-primary text-user-navbar-header"><?= $_SESSION["email"]; ?></p>
                </div>
            </div>
        </div>
        <div class="row mob-hidden">
            <a href="pages/reservations.php"><img src="assets/icons/navbar-menu-list.svg" style="height:24px;isplay:flex;align-self:center;margin:5px"></a>
            <a href="pages/logout.php"><img src="assets/icons/navbar-door-open-red.svg" style="height:24px;isplay:flex;align-self:center;margin:5px"></a>
        </div>
    </div>
    <div class="mrg-10"></div>
</div>

<script>
    // variables for hidden nav and burger menu button
    const burgerMenuButton = document.getElementById("userBurgerMenu");
    const userDropdown = document.getElementById("userDropdown");
    
    // function for burger menu opening and closing
    burgerMenuButton.addEventListener("click", function() {
        const isOpen = burgerMenuButton.classList.contains('rotate-clockwise-to-90');
        
        if (!isOpen) {
            openBurgerMenu();
        } else {
            closeBurgerMenu();
        }
    });

    function openBurgerMenu() {
        // rotate to 90deg = open menu
        burgerMenuButton.classList.remove('rotate-clockwise-to-90-reverse');
        void burgerMenuButton.offsetWidth;
        burgerMenuButton.classList.add('rotate-clockwise-to-90');
        userDropdown.classList.remove('burger-menu-close');
        void userDropdown.offsetWidth;
        userDropdown.classList.add('burger-menu-open');
        userDropdown.style.display = "block"; 
    }

    function closeBurgerMenu() {
        // rotate back = close menu
        burgerMenuButton.classList.remove('rotate-clockwise-to-90');
        void burgerMenuButton.offsetWidth;
        burgerMenuButton.classList.add('rotate-clockwise-to-90-reverse');
        userDropdown.classList.remove('burger-menu-open');
        void userDropdown.offsetWidth;
        userDropdown.classList.add('burger-menu-close');
    }
</script>