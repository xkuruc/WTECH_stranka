

function toggleSidebarKosik() {
    //document.getElementById('sidebar').classList.toggle('active');
    var sidebar = document.getElementById('kosik_sidebar');
    var overlay = document.querySelector('.overlay2');
    
    sidebar.classList.toggle('active');
    overlay.style.display = sidebar.classList.contains('active') ? "block" : "none";
    
}