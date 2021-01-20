// wow = new WOW({
//       boxClass: 'wow', // default
//       animateClass: 'animated', // default
//       offset: 0, // default
//       mobile: false, // default
//       live: true // default
// })
// wow.init();
$(document).ready(function () {
      $.ajaxSetup({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      // scroll to top in pages***************************************************************
      if ($('.go-top').length > 0) {
            $('.go-top').click(function () {
                  $('html').animate({
                        scrollTop: 0
                  }, 1000);
                  return false;
            });
      }

      $(window).scroll(function () {
            if ($(this).scrollTop() > 1000) {
                  $('.go-top , #cta').addClass('show');
            } else {
                  $('.go-top , #cta').removeClass('show');
            }
      });
      // End  scroll to top in pages**********************************************************


      // accordeon menu*******************************************************************
      $(".cardd-header").click(function () {
            // self clicking close
            if ($(this).next(".cardd-body").hasClass("active")) {
                  $(this).next(".cardd-body").removeClass("active").slideUp();
                  $(this).find("span").removeClass("fa-minus").addClass("fa-plus");
            } else {
                  // $(".cardd .cardd-body").removeClass("active").slideUp()
                  // $(".cardd .cardd-header span").removeClass("fa-minus").addClass("fa-plus");
                  $(this).next(".cardd-body").addClass("active").slideDown();
                  $(this).find("span").removeClass("fa-plus").addClass("fa-minus");
            }
      });

      // $(".cardd-header").children(".form-control").focusin(function() {
      //       $(".cardd-header").next(".cardd-body").addClass("active").slideDown();
      //       $(".cardd-header").children("span").removeClass("fa-plus").addClass("fa-minus");
      //       /* Act on the event */
      // });
      // $(".cardd-header").children(".form-control").focusout(function() {
      //       $(".cardd-header").next(".cardd-body").removeClass("active").slideUp();
      //       $(".cardd-header").children("span").removeClass("fa-minus").addClass("fa-plus");
      //       /* Act on the event */
      // });

      // End accordeon menu***************************************************************
      // res-sidebar
      $('.res-sidebar .res-btn .btn').click(function (event) {
            if (!$(this).hasClass('active')) {
                  $(this).parents('.res-sidebar').children('.abso-sidebar').css('right', '0px');
                  $(this).addClass('active')
                  $(this).children('i').removeClass('fa-bars');
                  $(this).children('i').addClass('fa-arrow-right');
            } else {
                  $(this).parents('.res-sidebar').children('.abso-sidebar').css('right', '-240px');
                  $(this).removeClass('active')
                  $(this).children('i').removeClass('fa-arrow-right');
                  $(this).children('i').addClass('fa-bars');
            }
      });
      // End res-sidebar

      // sliders
      if ($('.three-car').length > 0) {
            $('.three-car').owlCarousel({
                  rtl: true,
                  loop: true,
                  margin: 40,
                  nav: true,
                  responsive: {
                        0: {
                              items: 1
                        },
                        800: {
                              items: 2
                        },
                        1360: {
                              items: 3
                        }
                  }
            });
      }


      if ($('.two-car').length > 0) {
            $('.two-car').owlCarousel({
                  rtl: true,
                  loop: true,
                  margin: 1,
                  nav: true,
                  responsive: {
                        0: {
                              items: 1
                        },
                        1200: {
                              items: 2
                        }
                  }
            });
      }


      if ($('.comments-s').length > 0) {
            $('.comments-s').owlCarousel({
                  rtl: true,
                  loop: true,
                  margin: 10,
                  nav: true,

                  responsive: {
                        0: {
                              items: 1
                        },
                        800: {
                              items: 1
                        },
                        1200: {
                              items: 1
                        }
                  }
            });
      }

      // sing-in page
    //   $('section.first-step .send-code').click(function () {
    //         $('section.first-step').fadeOut(320);
    //         setTimeout(function () {
    //               $('section.confiirm-code').fadeIn(320);
    //         }, 320);
    //   });
    $('.withpassword').click(function () {
        $('section.first-step').fadeOut(320);
        setTimeout(function () {
              $('section.log-step').fadeIn(320);
        }, 320);
  });
      $('.return-back').click(function () {
            $('section.confiirm-code').fadeOut(320);
            $('section.log-step').fadeOut(320);
            setTimeout(function () {
                  $('section.first-step').fadeIn(320);
            }, 320);
      });
      // End sing-in page

      // Advisor request
      $('.advisor-request .input-submit').click(function (e) {
            e.preventDefault();
            $('.advisor-request form').submit();
      });
      // End Advisor request

      // guided by academy it




      // Start Web.Main.Blogs Script
      $('.search-input').keyup(function () {
            var search_value = $(this).val();
            $.ajax({
                  type: "POST",
                  url: $(this).data('url'),
                  data: {
                        value: search_value
                  },
                  success: function (response) {
                        $('#content #items .row .outer ').fadeOut(280).delay(280).remove().stop();
                        // console.log(response);
                        $('#content #items .row').html(response).fadeOut(1).fadeIn(280).stop();
                  }
            });
      });
      // End Web.Main.Blogs Script




      // Start Web.Main.ConsultantList Script
      $('#ConsultantSearch').keyup(function () {
            var search_value = $(this).val();
            $.ajax({
                  type: "POST",
                  url: $(this).data('url'),
                  data: {
                        value: search_value
                  },
                  success: function (response) {
                        $('#items-list .item-list').fadeOut(280).delay(280).remove().stop();
                        // console.log(response);
                        $('#items-list').html(response).fadeOut(1).fadeIn(280).stop();
                  }
            });
      });
      // End Web.Main.ConsultantList Script




      // Start Admins.HomePage.edit Script
      if ($('.services-table .add-row').length) {
            let ie = 100;
            $('.services-table .add-row').click(function () {
                  $('.services-table tbody').append(
                        '<tr>' +
                        '<td><input type="text" name="services[' + ie + '][title]"' +
                        'class="form-control" placeholder="عنوان" ></td>' +
                        '<td><input type="text" name="services[' + ie + '][short_desc]"' +
                        'class="form-control" placeholder="توضیح مختصر" ></td>' +
                        '<td>'+
                        '<input type="text" name="services[' + ie + '][link]"'+
                        'class="form-control" placeholder="Blogs/Category/100" >'+
                        '</td>'+
                        '</tr>'
                  );
                  ie++;
            });
            $('.services-table .remove-row').click(function () {
                  $('.services-table tbody tr').last().remove();
            });
      }



      if ($('.details-table .add-row').length) {
            let ie = 100;
            $('.details-table .add-row').click(function () {
                  $('.details-table table tbody').append(
                        '<tr>' +
                        '<td><input type="text" name="guidences[' + ie + '][title]"' +
                        'class="form-control" placeholder="عنوان"></td>' +
                        '<td><input type="text" name="guidences[' + ie + '][description]"' +
                        'class="form-control" placeholder="توضیح مختصر"></td>' +
                        '</tr>'
                  );
                  ie++;
            });
            $('.details-table .remove-row').click(function () {
                  $('.details-table tbody tr').last().remove();
            });
      }



      if ($('.trust-table .add-row').length) {
            let ie = 100;
            $('.trust-table .add-row').click(function () {
                  $('.trust-table table tbody').append(
                        '<tr>'+
                        '<td style="max-width: 120px;">'+
                        '<div class="custom-file">'+
                        '<input type="file" class="image custom-file-input customFile" name="footer[trust][items][' + ie + '][trust_image]">'+
                        '<label class="custom-file-label" for="customFile">انتخاب '+
                        'عکس</label>'+
                        '</div>'+
                        '<div class="row justify-content-center mt-3">'+
                        '<img class="image justify-content col-7" src="" alt="عکسی انتخاب نشده است">'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<input type="text" name="footer[trust][items][' + ie + '][trust_link]" class="form-control" placeholder="https://example.ir">'+
                        '</td>'+
                        '</tr>'
                  );
                  ie++;
            });
            $('.trust-table .remove-row').click(function () {
                  $('.trust-table tbody tr').last().remove();
            });
      }



      if ($('.social-media-table .add-row').length) {
            let ie = 100;
            $('.social-media-table .add-row').click(function () {
                  $('.social-media-table table tbody').append(
                        '<tr>'+
                        '<td style="max-width: 120px;">'+
                        '<div class="custom-file">'+
                        '<input type="file" class="image custom-file-input customFile" name="footer[social_media][' + ie + '][social_media_image]">'+
                        '<label class="custom-file-label" for="customFile">انتخاب'+
                        'عکس</label>'+
                        '</div>'+
                        '<div class="row justify-content-center mt-3">'+
                        '<img class="image justify-content col-7" src=""'+
                        'alt="عکسی انتخاب نشده است">'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<input type="text" name="footer[social_media][' + ie + '][social_media_link]" class="form-control"'+
                        'placeholder="https://.example.ir">'+
                        '</td>'+
                        '</tr>'
                  );
                  ie++;
            });
            $('.social-media-table .remove-row').click(function () {
                  $('.social-media-table tbody tr').last().remove();
            });
      }



      $('.select-comment-table .publication').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var ThisItem = $(this);
            $.ajax({
                  type: "post",
                  url: $(this).data('url'),
                  data: {
                        DataId: id
                  },
                  success: function (response) {
                        if (response) {
                              if (response == true) {
                                    ThisItem.toggleClass('btn-success');
                                    ThisItem.toggleClass('btn-secondary').text('انتخاب شده');
                                    toastr.success('وضعیت با موفقیت تغییر کرد');
                              }
                              if (response == false) {
                                    ThisItem.toggleClass('btn-success');
                                    ThisItem.toggleClass('btn-secondary').text('انتخاب نشده');
                                    toastr.success('وضعیت با موفقیت تغییر کرد');
                              }
                        }
                        else {
                              toastr.warning('مشکلی پیش آمده است');
                        }
                  }
            });
      });
      // End Admins.HomePage.edit Script




      // Start Admins.AboutUs.edit Script
      if ($('.advantages-form table .add-row')) {
            let ie = 100;
            $('.advantages-form table .add-row').click(function () {
                  $('.advantages-form table tbody').append(
                        '<tr>' +
                        '<td><input type="text" name="advantages[' + ie + '][title]"' +
                        'class="form-control" placeholder="عنوان" required></td>' +
                        '<td><input type="text" name="advantages[' + ie + '][short_desc]"' +
                        'class="form-control" placeholder="توضیح مختصر" required></td>' +
                        '</tr>'
                  );
                  ie++;
            });
            $('.advantages-form table .remove-row').click(function () {
                  $('.advantages-form table tbody tr').last().remove();
            });
      }
      // End Admins.AboutUs.edit Script




      // Start Admins.AboutUs.edit Script
      if ($('.subject-tags-form .add-row')) {
            let ie = 100;
            $('.subject-tags-form .add-row').click(function () {
                  $('.subject-tags-form .body').append(
                        '<input class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3" type="text" name="tags['+ ie +']">'
                  );
                  ie++;
            });
            $('.subject-tags-form .remove-row').click(function () {
                  $('.subject-tags-form .body input').last().remove();
            });
      }
      // End Admins.AboutUs.edit Script




      // Start Admins.Subject.edit Script
      $('.subject-comment-table .publication').click(function () {
            var id = $(this).data('id');
            var ThisItem = $(this);
            $.ajax({
                  type: "post",
                  url: $(this).data('url'),
                  data: {
                        DataId: id
                  },
                  success: function (response) {
                        if (response) {
                              if (response == true) {
                                    ThisItem.toggleClass('btn-success');
                                    ThisItem.toggleClass('btn-secondary').text('منتشر شده');
                                    toastr.success('وضعیت با موفقیت تغییر کرد');
                              }
                              if (response == false) {
                                    ThisItem.toggleClass('btn-success');
                                    ThisItem.toggleClass('btn-secondary').text('منتشر نشده');
                                    toastr.success('وضعیت با موفقیت تغییر کرد');
                              }
                        }
                        else {
                              toastr.warning('مشکلی پیش آمده است');
                        }
                  }
            });
      });
      // End Admins.Subject.edit Script




      // Start Advisors.Main.Profile Script
      if ($('.bio-form table .add-row').length > 0) {
            let ie = 100;
            $('.bio-form table .add-row').click(function () {
                  $('.bio-form table tbody').append(
                        '<tr>' +
                        '<td><input type="text"  name="education[' + ie + '][skill]" class="form-control" placeholder="تخصص"></td>' +
                        '<td><input type="text"  name="education[' + ie + '][certification]" class="form-control" placeholder="مدرک تحصیلی"></td>' +
                        '<td><input type="text"  name="education[' + ie + '][location]" class="form-control" placeholder="محل تحصیل"></td>' +
                        '<td><input type="text"  name="education[' + ie + '][date]" class="form-control" placeholder="تاریخ فارغ التحصیلی"></td>' +
                        '</tr>'
                  );
                  ie++;
            });
            $('.bio-form table .remove-row').click(function () {
                  $('.bio-form table tbody tr').last().remove();
            });
      }


      // if ($('.ck_text_editor').length) {
      //     var editors = $('.ck_text_editor');
      //     $.each(editors, function (i, item) {
      //         CKEDITOR.replace(item, {
      //             filebrowserUploadUrl: "{{ route('CKEDITOR', ['_token' => csrf_token() ]) }}",
      //             filebrowserImageUploadUrl: "{{ route('CKEDITOR', ['_token' => csrf_token() ]) }}",
      //             height: 200
      //         });
      //     });
      // }
      // End Web.Main.ConsultantList Script




      // Start layout.Advisors.template Script
      $('.navbar .header-body .navbar-nav li .Online').click(function (e) {
            e.preventDefault();
            $.ajax({
                  type: "post",
                  url: $(this).data('url'),
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function (response) {
                        if (response == true) {
                              $('.navbar .header-body .navbar-nav li a .avatar').toggleClass('avatar-state-success');
                              $('.navbar .header-body .navbar-nav li .Online').toggleClass('btn-success');
                              $('.navbar .header-body .navbar-nav li .Online').toggleClass('btn-warning');
                              toastr.success('وضعیت شما با موفقیت تغییر کرد');
                        }
                        else {
                              toastr.warning('مشکلی پیش آمده است');
                        }
                  }
            });
      });
      // End layout.Advisors.template Script



      // Start Image Uploader
      if ($('#customFile , .customFile ').length) {
            $(function () {
                  btn = $('#customFile , .customFile');

                  $(document).on("click", '#customFile , .customFile' , function() {
                        img = $(this).parents('.custom-file').siblings('.row').children('#image , img');
                        img.animate({
                              opacity: 0
                        }, 300);
                  });

                  $(document).on("change", '#customFile , .customFile' , function(e) {
                        var i = 0;
                        for (i; i < e.originalEvent.srcElement.files.length; i++) {
                              var file = e.originalEvent.srcElement.files[i],
                                    reader = new FileReader();
                              reader.onloadend = function () {
                                    img.attr('src', reader.result).animate({
                                          opacity: 1
                                    }, 700);
                              }
                              reader.readAsDataURL(file);
                        }
                  });
            });
            // Guided by Elisabeth Hamel (https://codepen.io/elisabeth_hamel/pen/QjRgRr)
      }
      // End Image Uploader
});
// End document.ready***************************************************************
