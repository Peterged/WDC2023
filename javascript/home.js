const sidebar = document.querySelector(".box-container .sidebar");

document.querySelector('.box-container .sidebar .sidebar-toggler').addEventListener('click', () => {
    sidebar.classList.toggle('active');
    if(!sidebar.getAttribute('user-controlled'))
        sidebar.setAttribute('user-controlled', 'true');
    else 
        sidebar.setAttribute('user-controlled', '');
});

document.querySelector('.box-container .sidebar .sidebar-responsive-toggler').addEventListener('click', () => {
    sidebar.classList.toggle('active');
    if(!sidebar.getAttribute('user-controlled'))
        sidebar.setAttribute('user-controlled', 'true');
    else 
        sidebar.setAttribute('user-controlled', '');
});

if(window.innerWidth >= "1000"){
    sidebar.classList.remove('active');
} else {
    sidebar.classList.add('active');
}   


window.addEventListener('resize', () => {
    if(window.innerWidth >= "1170" && !sidebar.getAttribute('user-controlled')){
        sidebar.classList.remove('active');
    } else if(window.innerWidth < "1170") {
        sidebar.classList.add('active');
    }   
})