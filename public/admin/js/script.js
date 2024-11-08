//---Cotisation mensuelle - mois et annee non payé
$(document).ready(function() {
    // Lors de la sélection d'un utilisateur
    $('#cotisation_mensuelle_user_id').change(function() {
        var userId = $(this).val(); // Récupérer l'ID de l'utilisateur sélectionné

        if (userId) {
            // Effectuer une requête AJAX pour récupérer les périodes non payées
            $.ajax({
                url: '/cotisations-mensuelle/periode-non-paye/' + userId,
                type: 'GET',
                success: function(data) {
                    // Vider les options existantes
                    $('#periods').empty();
                                        
                    // Ajouter les options de périodes non payées au champ 'periods'
                    if (data.length > 0) {
                        $.each(data, function(index, period) {
                            // Ajouter chaque période à la liste déroulante
                            $('#periods').append('<option value="' + period.mois + '-' + period.annee + '">' +
                                'Mois: ' + period.mois + ' - Année: ' + period.annee + 
                                '</option>');
                        });
                    } else {
                        // Si aucune période non payée, afficher un message
                        $('#periods').append('<option value="">Aucune période non payée</option>');
                    }
                },
                error: function() {
                    alert('Erreur lors de la récupération des périodes non payées.');
                }
            });

        } else {
            // Si aucun utilisateur sélectionné, vider le champ des périodes
            $('#periods').empty().append('<option value="">Sélectionner un utilisateur</option>');
        }
    });
});


//---Fonction de vérification des élément requis d'un formulaire
function formVirify(form) {
    var no_error = true;

    form.find('.ess-is-required').each(function(){
        let val = $.trim($(this).val());
        let msg = $.trim($(this).attr('data-msg'));

        if(val==""){
            $.alert(msg);

            no_error = false;
            return false;
        }
    });

    return no_error;
}




$( document ).ready(function() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    })


    $.ajax({
        type: "GET",
        url: "http://mysite.com/photos/PhotoGallery.xml", // replace with absolute URL of your gallery's xml file
        dataType: "xml",
        success: function(xml) {
          $(xml).find('img').each(function() {
            var location = 'http://mysite.com/photos/'; // replace with absolute path to the directory that holds your images
            var url = $(this).attr('src');
            var alt = $(this).attr('alt');
            $('<li></li>').html('<a href="' + location + '' + url + '"><img src="' + location + '' + url + '" alt="' + alt + '"/></a>').appendTo('#gallery');
          });
        }
      });

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
          $('.sidebar .collapse').collapse('hide');
        };
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function() {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
        };
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
          var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;
          this.scrollTop += (delta < 0 ? 1 : -1) * 30;
          e.preventDefault();
    }
    });

    // Scroll to top button appear
    $(document).on('scroll', function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
          $('.scroll-to-top').fadeIn();
        } else {
          $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
          scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });


    //---select2
    if($('.ess-select2').length){
        $('.ess-select2').select2({
        });
    }


    //---dataTable
    if($('.ess-dataTable').length){
        $('.ess-dataTable').DataTable( {
            "ordering": false,
            "language": {
                "lengthMenu": "_MENU_",
                "zeroRecords": "Aucune donnée disponible",
                "info": "Page _PAGE_ / _PAGES_ (_TOTAL_)",
                "search": "",
                "infoEmpty": "",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "oPaginate": {
                    "sNext": "<i class='fas fa-arrow-right'></i>",
                    "sPrevious": "<i class='fas fa-arrow-left'></i>",
                    "sFirst": "Premier",
                    "sLast": "Dernier"
                },
            }
        });
        $('#DataTables_Table_0_filter label input').attr('placeholder', "Recherche...");
    }


    //----Date picker
    if($('.ess-datepicker').length){
        $('.ess-datepicker').datepicker({
            language: 'fr-FR'
        });
    }

    //---Inputmask-email
    if($('.ess-inputmask-email').length){
        $(".ess-inputmask-email").inputmask({ alias: "email"});
    }
    if($('.ess-inputmask-numeric').length){
        $(".ess-inputmask-numeric").inputmask({ alias: "numeric"});
    }


    //---Form values checking
    $('.ess-form-checked').submit(function(e) {
        var form = $(this);

        if(formVirify(form)){

        }
        else{
            e.preventDefault();
        }
    });

    //---Form values checking
    $('.ess-link-checked').click(function(e) {
        var link = $(this).attr('href');
        var msg = $(this).attr('data-msg');
        e.preventDefault();

        $.confirm({
            title: 'CONFIRMATION',
            typeAnimated: true,
            backgroundDismiss: true,
            content: msg,
            buttons: {
                somethingElse: {
                    text: 'Oui <i class="fas fa-check"></i>',
                    action: function(){
                        window.location.href = link;
                    }
                }
            }
        });
    });





    $('.exitCat').change(function (e) {
        let exitCat = $.trim($(this).val());
        if(exitCat!=''){
            $('.newCat').val('');
        }
    });
    $('.newCat').keyup(function (e) {
        let exitCat = $.trim($(this).val());
        if(exitCat!=''){
            $('.exitCat').val('').trigger('change');
        }
    });


    //---Ajouter un produit à la vente
    $('.saleAddProduct').change(function (e) {
        let element = $(this);
        let productId = $.trim(element.val());
        let content = $.trim(element.attr('data-content'))+'/'+productId;

        if(productId=='') return false;
        saleProduct(content);
    });
    //---Modifier un produit de la vente
    $('.saleEditProduct').click(function (e) {
        let element = $(this);
        let productId = element.attr('data-id');
        let content = $.trim(element.attr('data-content'))+'/'+productId;

        saleProduct(content);
    });
    function saleProduct(content) {
        $.confirm({
            title: false,
            columnClass: 'medium',
            content: 'url:'+content,
            backgroundDismiss: true,
            buttons: {
                formSubmit: {
                    text: 'Ajouter',
                    btnClass: 'btn-blue',
                    action: function () {
                        let qte = $.trim(this.$content.find('.sale-product-qte').val());
                        if(qte==0){
                            $.alert("Veuillez renseigner la quantité");
                            return false;
                        }
                        else if(qte<0){
                            $.alert("Veuillez renseigner une quantité supérieur à '0'");
                            return false;
                        }
                        else{
                            this.$content.find('.form-sale-product').submit();
                        }
                    }
                },
            },
            onContentReady: function () {
                $('.sale-product-qte').keyup(function (e) {
                    let val = $.trim($(this).val())*1;
                    let qte = $.trim($(this).attr('data-qte'))*1;
                    if(val>qte){
                        $(this).val(qte);
                    }
                    else{

                    }
                });
            },
        });
    }


    //---Montant versé
    $('.cash').keyup(function (e) {
        let element = $(this);
        let cash = $.trim(element.val()) * 1;
        let tt = $.trim(element.attr('data-tt')) * 1;
        console.log('tt : '+tt);

        var change = cash - tt;
        if(change>=0){
            $('.change').html('Monaie : '+new Intl.NumberFormat().format(cash - tt)+' <small>fcfa</small>');
        }
        else{
            $('.change').html("Dû : "+ new Intl.NumberFormat().format(-1*(cash - tt))+' <small>fcfa</small>');
        }
    });


    //---Form nouvelle vente
    $('.form-new-sale').submit(function(e) {
        var form = $(this);
        let tt = $.trim($('#sate-new-tt').val())*1;
        let cash = $.trim($('#sale-new-cash').val())*1;
        let fullName = $.trim($('#sale-new-fullName').val());
        let phone = $.trim($('#sale-new-phone').val());
        let customerId = $.trim($('#sale-new-customerId').val());

        if(formVirify(form)){
            if(cash<tt && fullName=="" && customerId==""){
                $.alert("Veuillez definir le client vue qu'il reste "+new Intl.NumberFormat().format(tt - cash)+' <small>fcfa</small> à payer');
                e.preventDefault();
            }
        }
        else{
            e.preventDefault();
        }
    });

});



