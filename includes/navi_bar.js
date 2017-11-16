
 $('document').ready(function() {
    $('.navbar-collapse li a').each(function() {
        if ('http://localhost/ip_project/'+$(this).attr('href') == window.location.href)
        {
            $(this).parent().addClass('active');
        }
    });
}); 