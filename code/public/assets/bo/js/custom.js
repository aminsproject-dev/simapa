/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */
// SWEET ALERT
const SweetAlert = (function () {
  //
  // Setup module components
  //

  // Sweet Alerts
  const _componentSweetAlert = function () {
    if (typeof swal == "undefined") {
      console.warn("Warning - sweet_alert.min.js is not loaded.");
      return;
    }

    // Defaults
    const swalInit = swal.mixin({
      buttonsStyling: false,
      customClass: {
        confirmButton: "btn btn-primary",
        cancelButton: "btn btn-light",
        denyButton: "btn btn-light",
        input: "form-control",
      },
    });

    const swalSuccessElementCustom = document.querySelector(
      "#sweet_success_custom",
    );

    if (swalSuccessElementCustom) {
      const rawMessage = $("#sweet_success_custom").data("message");
      const successMessage = normalizeMessage(rawMessage);

      swalInit.fire({
        title: "Berhasil!",
        text: successMessage,
        icon: "success",
      });
    }

    const swalErrorElementCustom = document.querySelector(
      "#sweet_error_custom",
    );

    if (swalErrorElementCustom) {
      const rawMessage = $("#sweet_error_custom").data("message");
      const errorMessage = normalizeMessage(rawMessage);

      swalInit.fire({
        title: "Gagal!",
        text: errorMessage,
        icon: "error",
      });
    }

    function normalizeMessage(message) {
      // Jika sudah object (karena jQuery auto-parse)
      if (typeof message === "object") {
        return Object.values(message).join("\n");
      }

      // Jika string JSON
      try {
        const parsed = JSON.parse(message);
        if (Array.isArray(parsed)) {
          return parsed.join("\n");
        }
        if (typeof parsed === "object") {
          return Object.values(parsed).join("\n");
        }
        return parsed;
      } catch (e) {
        // String biasa
        return message;
      }
    }

    //
    // Contextual alerts
    //

    // const swalSuccessElementCustom = document.querySelector(
    //   "#sweet_success_custom"
    // );
    // if (swalSuccessElementCustom) {
    //   var successMessage = $("#sweet_success_custom").data("message");
    //   swalInit.fire({
    //     title: "Berhasil!",
    //     text: successMessage,
    //     icon: "success",
    //   });
    // }

    // Warning Delete alert
    $(document).on("click", ".sweet_warning_custom", function (event) {
      event.preventDefault();
      const url = $(this).data("url");

      swalInit
        .fire({
          title: "Apa anda yakin?",
          text: "Data akan hilang secara permanen!!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Lanjutkan",
        })
        .then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        });
    });

    $(document).on("click", ".sweet_warning_label", function (event) {
      event.preventDefault();
      const url = $(this).data("url");
      const message = $(this).data("message");

      swalInit
        .fire({
          title: "Apa anda yakin?",
          text: message,
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Lanjutkan",
        })
        .then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        });
    });

    $(document).on("click", ".sweet_tambah", function (event) {
      event.preventDefault();
      const form = $(this).closest("form.form_tambah");

      if (!form[0].checkValidity()) {
        form[0].reportValidity();
        return;
      }

      swalInit
        .fire({
          title: "Anda yakin data sudah benar?",
          text: "Data akan di simpan!!",
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Lanjutkan",
        })
        .then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
    });

    $(document).on("click", ".sweet_confirm", function (event) {
      const url = $(this).data("url");
      const message = $(this).data("message");

      swalInit
        .fire({
          title: "Anda yakin data sudah benar?",
          text: message,
          icon: "info",
          showCancelButton: true,
          confirmButtonText: "Lanjutkan",
        })
        .then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        });
    });

    // Gagal Alert
    // const swalErrorElementCustom = document.querySelector(
    //   "#sweet_error_custom"
    // );
    // if (swalErrorElementCustom) {
    //   var errorMessage = $("#sweet_error_custom").data("message");
    //   swalInit.fire({
    //     title: "Gagal!!",
    //     text: errorMessage,
    //     icon: "error",
    //   });
    // }

    // Success alert
    const swalSuccessElement = document.querySelector("#sweet_success");
    if (swalSuccessElement) {
      swalSuccessElement.addEventListener("click", function () {
        swalInit.fire({
          title: "Good job!",
          text: "You clicked the button!",
          icon: "success",
        });
      });
    }

    // Error alert
    const swalErrorElement = document.querySelector("#sweet_error");
    if (swalErrorElement) {
      swalErrorElement.addEventListener("click", function () {
        swalInit.fire({
          title: "Oops...",
          text: "Something went wrong!",
          icon: "error",
        });
      });
    }

    // Warning alert
    const swalWarningElement = document.querySelector("#sweet_warning");
    if (swalWarningElement) {
      swalWarningElement.addEventListener("click", function () {
        swalInit.fire({
          title: "Are you sure?",
          text: "You will not be able to recover this imaginary file!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
        });
      });
    }

    // Info alert
    const swalInfoElement = document.querySelector("#sweet_info");
    if (swalInfoElement) {
      swalInfoElement.addEventListener("click", function () {
        swalInit.fire({
          title: "For your information",
          text: "This is some sort of a custom alert",
          icon: "info",
        });
      });
    }

    // Question
    const swalQuestionElement = document.querySelector("#sweet_question");
    if (swalQuestionElement) {
      swalQuestionElement.addEventListener("click", function () {
        swalInit.fire({
          title: "Got question?",
          text: "You will get the answer soon!",
          icon: "question",
        });
      });
    }

    // Alert combinatio
    const swalCombineElement = document.querySelector("#sweet_combine");
    if (swalCombineElement) {
      swalCombineElement.addEventListener("click", function () {
        swalInit
          .fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            buttonsStyling: false,
            customClass: {
              confirmButton: "btn btn-success",
              cancelButton: "btn btn-danger",
            },
          })
          .then(function (result) {
            if (result.value) {
              swalInit.fire(
                "Deleted!",
                "Your file has been deleted.",
                "success",
              );
            } else if (result.dismiss === swal.DismissReason.cancel) {
              swalInit.fire(
                "Cancelled",
                "Your imaginary file is safe :)",
                "error",
              );
            }
          });
      });
    }
  };

  //
  // Return objects assigned to module
  //

  return {
    initComponents: function () {
      _componentSweetAlert();
    },
  };
})();

// DATATABLES
const DatatableBasic = (function () {
  //
  // Setup module components
  //

  // Basic Datatable examples
  const _componentDatatableBasic = function () {
    if (!$().DataTable) {
      console.warn("Warning - datatables.min.js is not loaded.");
      return;
    }

    // Setting datatable defaults
    $.extend($.fn.dataTable.defaults, {
      autoWidth: false,
      responsive: true,
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [5],
        },
      ],
      dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
      language: {
        search:
          '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
        searchPlaceholder: "Type to filter...",
        lengthMenu: '<span class="me-3">Show:</span> _MENU_',
        paginate: {
          first: "First",
          last: "Last",
          next: document.dir == "rtl" ? "&larr;" : "&rarr;",
          previous: document.dir == "rtl" ? "&rarr;" : "&larr;",
        },
      },
    });

    $(".datatable-1").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [1],
        },
      ],
    });
    $(".datatable-2").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [2],
        },
      ],
    });
    $(".datatable-3").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [3],
        },
      ],
    });
    $(".datatable-4").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [4],
        },
      ],
    });
    $(".datatable-5").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [5],
        },
      ],
    });
    $(".datatable-6").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [6],
        },
      ],
    });
    $(".datatable-7").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [7],
        },
      ],
    });
    $(".datatable-8").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [8],
        },
      ],
    });
    $(".datatable-9").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [9],
        },
      ],
    });
    $(".datatable-10").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [10],
        },
      ],
    });
    $(".datatable-11").DataTable({
      columnDefs: [
        {
          orderable: false,
          width: 100,
          targets: [11],
        },
      ],
    });

    // Scrollable datatable
    const table = $(".datatable-scroll-y").DataTable({
      autoWidth: true,
      scrollY: 300,
    });

    // Resize scrollable table when sidebar width changes
    $(".sidebar-control").on("click", function () {
      table.columns.adjust().draw();
    });
  };

  //
  // Return objects assigned to module
  //

  return {
    init: function () {
      _componentDatatableBasic();
    },
  };
})();

// SELECT2
var Select2Selects = (function () {
  //
  // Setup module components
  //

  const _select2CustomPicker = function () {
    const currentYear = new Date().getFullYear();
    const startYear = currentYear - 10;
    const endYear = currentYear + 10; // Menampilkan hingga 10 tahun ke depan

    // Membuat array tahun
    let years = [];
    for (let year = startYear; year <= endYear; year++) {
      years.push(year);
    }

    // Menambahkan tahun ke dalam elemen select
    const yearOptions = years.map((year) => {
      return { id: year, text: year };
    });

    $(".year-picker").select2({
      data: yearOptions,
      placeholder: "Pilih Tahun",
      allowClear: true,
    });
  };

  // Select2 examples
  var _componentSelect2 = function () {
    if (!$().select2) {
      console.warn("Warning - select2.min.js is not loaded.");
      return;
    }

    //
    // Basic examples
    //

    // Default initialization
    $(".select").select2();

    document.querySelectorAll(".select-search").forEach((element) => {
      $(element).select2({
        disabled: false,
      });
    });

    $(".select-disabled").select2({
      disabled: true,
    });
  };

  //
  // Return objects assigned to module
  //

  return {
    init: function () {
      _componentSelect2();
      _select2CustomPicker();
    },
  };
})();

// CKEDITOR
const CKEditorClassic = (function () {
  //
  // Setup module components
  //

  // CKEditor
  const _componentCKEditorClassic = function () {
    if (typeof ClassicEditor == "undefined") {
      console.warn("Warning - ckeditor_classic.js is not loaded.");
      return;
    }

    document.querySelectorAll(".ckeditor_classic").forEach((editorElement) => {
      ClassicEditor.create(editorElement, {
        toolbar: [
          "heading",
          "|",
          "bold",
          "italic",
          "link",
          "bulletedList",
          "numberedList",
          "blockQuote",
        ],
        height: 500,
      }).catch((error) => {
        console.error(error);
      });
    });

    document.querySelectorAll(".ckeditor_readonly").forEach((editorElement) => {
      ClassicEditor.create(editorElement, {
        toolbar: [
          "heading",
          "|",
          "bold",
          "italic",
          "link",
          "bulletedList",
          "numberedList",
          "blockQuote",
        ],
        height: 500,
      })
        .then((editor) => {
          // Atur editor menjadi readonly
          editor.enableReadOnlyMode("manualReadOnly");
        })
        .catch((error) => {
          console.error(error);
        });
    });
  };

  //
  // Return objects assigned to module
  //

  return {
    init: function () {
      _componentCKEditorClassic();
    },
  };
})();

// STEP WIZARD
const FormWizard = (function () {
  //
  // Setup module components
  //

  // Wizard
  const _componentWizard = function () {
    if (!$().steps) {
      console.warn("Warning - steps.min.js is not loaded.");
      return;
    }

    // var formSubmit = $(".steps-basic");
    // Basic wizard setup
    $(".steps-basic").steps({
      headerTag: "h6",
      bodyTag: "fieldset",
      transitionEffect: "fade",
      titleTemplate: '<span class="number">#index#</span> #title#',
      labels: {
        previous:
          document.dir == "rtl"
            ? '<i class="ph-arrow-circle-right me-2"></i> Previous'
            : '<i class="ph-arrow-circle-left me-2"></i> Previous',
        next:
          document.dir == "rtl"
            ? 'Next <i class="ph-arrow-circle-left ms-2"></i>'
            : 'Next <i class="ph-arrow-circle-right ms-2"></i>',
        finish: 'Submit form <i class="ph-paper-plane-tilt ms-2"></i>',
      },
      onFinished: function (event, currentIndex) {
        // formSubmit.submit();
      },
    });

    // Async content loading
    $(".steps-async").steps({
      headerTag: "h6",
      bodyTag: "fieldset",
      transitionEffect: "fade",
      titleTemplate: '<span class="number">#index#</span> #title#',
      loadingTemplate:
        '<div class="card-body text-center"><i class="icon-spinner2 spinner me-2"></i>  #text#</div>',
      labels: {
        previous:
          document.dir == "rtl"
            ? '<i class="ph-arrow-circle-right me-2"></i> Previous'
            : '<i class="ph-arrow-circle-left me-2"></i> Previous',
        next:
          document.dir == "rtl"
            ? 'Next <i class="ph-arrow-circle-left ms-2"></i>'
            : 'Next <i class="ph-arrow-circle-right ms-2"></i>',
        finish: 'Submit form <i class="ph-paper-plane-tilt ms-2"></i>',
      },
      onContentLoaded: function (event, currentIndex) {
        $(this).find(".card-body").addClass("hide");
      },
      onFinished: function (event, currentIndex) {
        alert("Form submitted.");
      },
    });

    // Specify custom starting step
    $(".steps-starting-step").steps({
      headerTag: "h6",
      bodyTag: "fieldset",
      titleTemplate: '<span class="number">#index#</span> #title#',
      labels: {
        previous:
          document.dir == "rtl"
            ? '<i class="ph-arrow-circle-right me-2"></i> Previous'
            : '<i class="ph-arrow-circle-left me-2"></i> Previous',
        next:
          document.dir == "rtl"
            ? 'Next <i class="ph-arrow-circle-left ms-2"></i>'
            : 'Next <i class="ph-arrow-circle-right ms-2"></i>',
        finish: 'Submit form <i class="ph-paper-plane-tilt ms-2"></i>',
      },
      transitionEffect: "fade",
      startIndex: 2,
      autoFocus: true,
      onFinished: function (event, currentIndex) {
        alert("Form submitted.");
      },
    });

    // Enable all steps and make them clickable
    $(".steps-enable-all").steps({
      headerTag: "h6",
      bodyTag: "fieldset",
      transitionEffect: "fade",
      enableAllSteps: true,
      titleTemplate: '<span class="number">#index#</span> #title#',
      labels: {
        previous:
          document.dir == "rtl"
            ? '<i class="ph-arrow-circle-right me-2"></i> Previous'
            : '<i class="ph-arrow-circle-left me-2"></i> Previous',
        next:
          document.dir == "rtl"
            ? 'Next <i class="ph-arrow-circle-left ms-2"></i>'
            : 'Next <i class="ph-arrow-circle-right ms-2"></i>',
        finish: 'Submit form <i class="ph-paper-plane-tilt ms-2"></i>',
      },
      onFinished: function (event, currentIndex) {
        alert("Form submitted.");
      },
    });

    //
    // Wizard with validation
    //

    // Stop function if validation is missing
    if (!$().validate) {
      console.warn("Warning - validate.min.js is not loaded.");
      return;
    }

    // Show form
    var form = $(".steps-validation").show();

    // Initialize wizard
    $(".steps-validation").steps({
      headerTag: "h6",
      bodyTag: "fieldset",
      titleTemplate: '<span class="number">#index#</span> #title#',
      labels: {
        previous:
          document.dir == "rtl"
            ? '<i class="ph-arrow-circle-right me-2"></i> Previous'
            : '<i class="ph-arrow-circle-left me-2"></i> Previous',
        next:
          document.dir == "rtl"
            ? 'Next <i class="ph-arrow-circle-left ms-2"></i>'
            : 'Next <i class="ph-arrow-circle-right ms-2"></i>',
        finish: 'Submit form <i class="ph-paper-plane-tilt ms-2"></i>',
      },
      transitionEffect: "fade",
      autoFocus: true,
      onStepChanging: function (event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
          return true;
        }

        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
          // To remove error styles
          form.find(".body:eq(" + newIndex + ") label.error").remove();
          form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }

        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
      },
      onFinishing: function (event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
      },
      onFinished: function (event, currentIndex) {
        if (confirm("Anda yakin data sudah benar?")) {
          var formData = $(".steps-validation").serialize();
          console.log(formData);
          form.submit();
        }
      },
    });

    // Initialize validation
    $(".steps-validation").validate({
      ignore: "input[type=hidden], .select2-search__field", // ignore hidden fields
      errorClass: "validation-invalid-label",
      highlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
      },
      unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
      },

      // Different components require proper error label placement
      errorPlacement: function (error, element) {
        // Unstyled checkboxes, radios
        if (element.parents().hasClass("form-check")) {
          error.appendTo(element.parents(".form-check").parent());
        }

        // Input with icons and Select2
        else if (
          element.parents().hasClass("form-group-feedback") ||
          element.hasClass("select2-hidden-accessible")
        ) {
          error.appendTo(element.parent());
        }

        // Input group, styled file input
        else if (
          element.parent().is(".uniform-uploader, .uniform-select") ||
          element.parents().hasClass("input-group")
        ) {
          error.appendTo(element.parent().parent());
        }

        // Other elements
        else {
          error.insertAfter(element);
        }
      },
      rules: {
        nik: {
          minlength: 16,
          maxlength: 16,
        },
      },
      messages: {
        nik: {
          required: "NIK harus diisi",
          minlength: jQuery.validator.format("NIK harus {0} karakter"),
          maxlength: jQuery.validator.format(
            "NIK tidak boleh lebih {0} karakter",
          ),
        },
      },
    });

    // const validationExampleElement = $(".steps-validation");
    // const form = validationExampleElement.show();
    // Initialize wizard
    // validationExampleElement.steps({
    //   headerTag: "h6",
    //   bodyTag: "fieldset",
    //   titleTemplate: '<span class="number">#index#</span> #title#',
    //   labels: {
    //     previous: document.dir == "rtl" ? '<i class="ph-arrow-circle-right me-2"></i> Previous' : '<i class="ph-arrow-circle-left me-2"></i> Previous',
    //     next: document.dir == "rtl" ? 'Next <i class="ph-arrow-circle-left ms-2"></i>' : 'Next <i class="ph-arrow-circle-right ms-2"></i>',
    //     finish: 'Submit form <i class="ph-paper-plane-tilt ms-2"></i>',
    //   },
    //   transitionEffect: "fade",
    //   autoFocus: true,
    //   onStepChanging: function (event, currentIndex, newIndex) {
    //     // Allways allow previous action even if the current form is not valid!
    //     if (currentIndex > newIndex) {
    //       return true;
    //     }

    //     // Needed in some cases if the user went back (clean up)
    //     if (currentIndex < newIndex) {
    //       // To remove error styles
    //       form.find(".body:eq(" + newIndex + ") label.error").remove();
    //       form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
    //     }

    //     $(".daterange-basic").daterangepicker({
    //       parentEl: ".content-inner",
    //     });

    //     form.validate().settings.ignore = ":disabled,:hidden";
    //     return form.valid();
    //   },
    //   onFinishing: function (event, currentIndex) {
    //     form.validate().settings.ignore = ":disabled";
    //     formSubmit.submit();
    //   },
    //   onFinished: function (event, currentIndex) {
    //     // formSubmit.submit();
    //   },
    // });

    // // Initialize validation
    // validationExampleElement.validate({
    //   ignore: ".select2-search__field", // ignore hidden fields
    //   errorClass: "validation-invalid-label",
    //   highlight: function (element, errorClass) {
    //     $(element).removeClass(errorClass);
    //   },
    //   unhighlight: function (element, errorClass) {
    //     $(element).removeClass(errorClass);
    //   },

    //   // Different components require proper error label placement
    //   errorPlacement: function (error, element) {
    //     // Input with icons and Select2
    //     if (element.hasClass("select2-hidden-accessible")) {
    //       error.appendTo(element.parent());
    //     }

    //     // Input group, form checks and custom controls
    //     else if (element.parents().hasClass("form-control-feedback") || element.parents().hasClass("form-check") || element.parents().hasClass("input-group")) {
    //       error.appendTo(element.parent().parent());
    //     }

    //     // Other elements
    //     else {
    //       error.insertAfter(element);
    //     }
    //   },
    //   rules: {
    //     email: {
    //       email: true,
    //     },
    //   },
    // });
  };

  //
  // Return objects assigned to module
  //

  return {
    init: function () {
      _componentWizard();
    },
  };
})();

// GALLERY
const Gallery = (function () {
  //
  // Setup module components
  //

  // Lightbox
  const _componentLightbox = function () {
    if (typeof GLightbox == "undefined") {
      console.warn("Warning - glightbox.min.js is not loaded.");
      return;
    }

    // Image lightbox
    const lightbox = GLightbox({
      selector: '[data-bs-popup="lightbox"]',
      loop: true,
      svg: {
        next:
          document.dir == "rtl"
            ? '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>'
            : '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"> <g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>',
        prev:
          document.dir == "rtl"
            ? '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>'
            : '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>',
      },
    });
  };

  //
  // Return objects assigned to module
  //

  return {
    init: function () {
      _componentLightbox();
    },
  };
})();

// ------------------------------
// Initialize module
// ------------------------------

document.addEventListener("DOMContentLoaded", function () {
  SweetAlert.initComponents();
  DatatableBasic.init();
  Select2Selects.init();
  CKEditorClassic.init();
  FormWizard.init();
  Gallery.init();
});
