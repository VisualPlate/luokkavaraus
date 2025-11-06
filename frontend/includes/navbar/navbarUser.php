<!--NAVBAR TO LOGGED IN USERS-->
<div class="pos-top pos-right mrg-15">
    <div class="user-navbar row space-between">
        <div class="row">
            <div>
                <img src="assets/icons/user-placeholder.svg" style="height:100%">
            </div>
            <div class="col col-cent">
                <div>
                    <p class="text-primary text-user-navbar-header">admin administrator</p>
                </div>
                <div>
                    <p class="text-user-navbar">admin@admin.admin</p>
                </div>
            </div>
        </div>
        <div>
            <img src="assets/icons/burger-menu-green.svg" style="height:100%" id="userBurgerMenu">
        </div>
    </div>
    <div class="mrg-10"></div>
    <div class="user-navbar-open space-between col" style="display:none"id="userDropdown">
        <div class="row space-between mrg-in-10">
            <a href="#" class="text-primary text-user-navbar-secondary" style="display:flex;align-self:center">Omat varaukset</a>
            <img src="assets/icons/burger-menu-green.svg" style="height:24px;isplay:flex;align-self:center">
        </div>
    </div>
</div>
<script>
    // variables for hidden nav and burger menu button
    const burgerMenuButton = document.getElementById("userBurgerMenu");
    const userDropdown = document.getElementById("userDropdown");

    // function for burger menu opening and closing
    burgerMenuButton.addEventListener("click", function() {
        const isOpen = burgerMenuButton.classList.contains('rotate-clockwise-to-90');
        
        if (!isOpen) {
            // rotate to 90deg = open menu
            burgerMenuButton.classList.remove('rotate-clockwise-to-90-reverse');
            void burgerMenuButton.offsetWidth;
            burgerMenuButton.classList.add('rotate-clockwise-to-90');
            openBurgerMenu();
        } else {
            // rotate back = close menu
            burgerMenuButton.classList.remove('rotate-clockwise-to-90');
            void burgerMenuButton.offsetWidth;
            burgerMenuButton.classList.add('rotate-clockwise-to-90-reverse');
            closeBurgerMenu();
        }
    });

    function openBurgerMenu() {
        userDropdown.classList.remove('burger-menu-close');
        void userDropdown.offsetWidth;
        userDropdown.classList.add('burger-menu-open');
        userDropdown.style.display = "block"; 
    }

    function closeBurgerMenu() {
        userDropdown.classList.remove('burger-menu-open');
        void userDropdown.offsetWidth;
        userDropdown.classList.add('burger-menu-close');
    }
</script>