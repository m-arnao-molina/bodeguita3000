$(document).ready(function()
{
    $('.contenedor-menu .menu .item').on('click', function(e)
    {
        e.preventDefault();

        if($(this).hasClass('item-activado'))
        {
            $(this).children('.subitems').slideUp();
            $(this).removeClass('item-activado');

        } else {
            $('.subitems').slideUp();
            $('.item').removeClass('item-activado');
            $(this).addClass('item-activado');
            $(this).children('.subitems').slideDown();
        }
    });

    $('.subitem-activado').parent().trigger("click");

    $('.menu .item .subitems li a').click(function(e)
    {
        e.stopPropagation();
        window.location.href = $(this).attr('href');
        
        if(! $(this).hasClass('subitem-activado'))
        {
            $('.subitems li').removeClass('subitem-activado');
            $(this).parent().addClass('subitem-activado');
        }
    });
});