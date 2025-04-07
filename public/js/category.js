

document.getElementById('toggle-sidebar').addEventListener('click', function () {
    console.log(123);
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('main-content').classList.toggle('active');
})
