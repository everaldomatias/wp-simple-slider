/**
 * Customizacoes jQuery para os sliders
 *
 **/

jQuery(document).ready(function () {

    var $ = jQuery.noConflict();

    /* Slider Default */
    $('.slider-default').carouFredSel({
        prev: '#prev-default',
        next: '#next-default',
        responsive: true,
        scroll: {
            fx: 'crossfade',
            items: 1,
            pauseOnHover: true
        },
        items: {
            visible: {
                min: 1,
                max: 4
            }
        }
    });
});