function toggleSidebar() {
    //document.getElementById('sidebar').classList.toggle('active');
    var sidebar = document.getElementById('sidebar');
    var overlay = document.querySelector('.overlay');
    
    sidebar.classList.toggle('active');
    overlay.style.display = sidebar.classList.contains('active') ? "block" : "none";
}

function toggleSubmenu(event) {
    //event.preventDefault();
    var li = event.target.closest("li"); 
    var submenu = li.querySelector(".submenu");
    var plusMinus = li.querySelector(".plus");
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}


function toggleSubmenuPanskeTenisky(event) {
    //event.preventDefault();
    var li = event.target.closest("li"); 
    var submenu = li.querySelector(".submenuPanskeTenisky");
    var plusMinus = li.querySelector(".plus");
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}

function toggleSubmenuDamskeTenisky(event) {
    //event.preventDefault();
    var li = event.target.closest("li"); 
    var submenu = li.querySelector(".submenuDamskeTenisky");
    var plusMinus = li.querySelector(".plus");
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}

function toggleSubmenuZnacky(event) {
    //event.preventDefault();
    var li = event.target.closest("li"); 
    var submenu = li.querySelector(".submenuZnacky");
    var plusMinus = li.querySelector(".plus");
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}

function toggleSubmenuDetskeTenisky(event) {
    var li = event.target.closest("li"); 
    var submenu = li.querySelector(".submenuDetskeTenisky");
    var plusMinus = li.querySelector(".plus");
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}

function toggleSubmenuDetskeTenisky(event) {
    var li = event.target.closest("li"); 
    var submenu = li.querySelector(".submenuDetskeTenisky");
    var plusMinus = li.querySelector(".plus");
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}


function toggleSubmenuMUZI(event) {
    var li = event.target.closest("li"); 
    var submenu = li.querySelector(".submenuMUZI");
    var plusMinus = li.querySelector(".plus");
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}

function toggleSubmenuZENY(event) {
    var li = event.target.closest("li"); 
    var submenu = li.querySelector(".submenuZENY");
    var plusMinus = li.querySelector(".plus");
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}

function toggleSubmenuDETI(event) {
    var li = event.target.closest("li"); 
    var submenu = li.querySelector(".submenuDETI");
    var plusMinus = li.querySelector(".plus");
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}
function toggleSubmenuZnackyOBLECENIE(event) {
    var li = event.target.closest("li"); 
    var submenu = li.querySelector(".submenuZnackyOBLECENIE");
    var plusMinus = li.querySelector(".plus");
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}