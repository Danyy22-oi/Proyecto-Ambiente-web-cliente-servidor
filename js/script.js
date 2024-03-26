var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/')+1);
var links = document.querySelectorAll('#menu ul li a');
for (var i = 0; i < links.length; i++) {
    var href = links[i].getAttribute('href');
    if (href === filename) {
        links[i].classList.add('active');
        break; 
    }
}



