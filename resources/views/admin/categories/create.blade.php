@extends('layouts.admin')

@section('title')
    Create Category
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/dropzone/basic.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/pnotify/pnotify.custom.css') }}" />
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/vendor/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/pnotify/pnotify.custom.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            var initializeDropzone = function() {
                $("#dropzone-form-image")
                    .dropzone({
                        url: "/admin/upload/image",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                        },
                        addRemoveLinks: true,
                        maxFiles: 1,
                        init: function() {
                            this.on('addedfile', function(file) {
                                if (this.files.length > 1) {
                                    this.removeFile(this.files[0]);
                                }
                            });
                            this.on('success', function(file, response) {
                                const {
                                    image
                                } = response

                                file.tmp_image = image
                            });
                            this.on('removedfile', function(file) {
                                $.ajax({
                                    url: '/admin/delete/image',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="token"]').attr(
                                            'content')
                                    },
                                    type: 'delete',
                                    data: {
                                        image: file.tmp_image
                                    },
                                    success: function({
                                        message
                                    }) {
                                        new PNotify({
                                            title: "Success",
                                            text: message,
                                            type: "success",
                                            addclass: "notification-success",
                                            icon: "fas fa-check",
                                        });
                                    },
                                    error: function(xhr) {
                                        new PNotify({
                                            title: "Error",
                                            text: message,
                                            type: "error",
                                            addclass: "notification-error",
                                            icon: "fas fa-times",
                                        });
                                    }
                                });
                            });
                        },
                    })
                    .addClass("dropzone initialized");
            };
            $(document).ready(function() {
                if ($("#dropzone-form-image").get(0)) {
                    initializeDropzone();
                }
            });
            $(window).on("ecommerce.sidebar.overlay.show", function() {
                if ($("#dropzone-form-image").get(0)) {
                    initializeDropzone();
                }
            });
            $(document).on("click", ".ecommerce-attribute-add-new", function(e) {
                e.preventDefault();
                var html =
                    "" +
                    '<div class="form-group row justify-content-center ecommerce-attribute-row">' +
                    '<div class="col-xl-3">' +
                    '<label class="control-label">Name</label>' +
                    '<input type="text" class="form-control form-control-modern" name="attName" value="" />' +
                    '<div class="checkbox mt-3 mb-3 mb-lg-0">' +
                    '<label class="my-2">' +
                    '<input type="checkbox" name="attVisible" value="">' +
                    "Visible on the item page" +
                    "</label>" +
                    "</div>" +
                    "</div>" +
                    '<div class="col-xl-6">' +
                    '<a href="#" class="ecommerce-attribute-remove text-color-danger float-end">Remove</a>' +
                    '<label class="control-label">Value(s)</label>' +
                    '<textarea class="form-control form-control-modern" name="attValue" rows="4" placeholder="Enter some text, or some attributes by | separating values"></textarea>' +
                    "</div>" +
                    "</div>" +
                    "";
                $(".ecommerce-attributes-wrapper").append(html);
            });
            $(document).on("click", ".ecommerce-attribute-remove", function(e) {
                e.preventDefault();
                $(this).closest(".ecommerce-attribute-row").remove();
            });
            var ecommerceFormValidate = function() {
                var $form = $(".ecommerce-form");
                $form.validate({
                    ignore: "",
                    invalidHandler: function(form, validator) {
                        var errors = validator.numberOfInvalids();
                        if (errors) {
                            $(".form-control.error").each(function() {
                                var tab_id = $(this).closest(".tab-pane").attr("id");
                                $('.nav-link[href="#' + tab_id + '"]').trigger("click");
                                return false;
                            });
                        }
                    },
                    submitHandler: function(form) {
                        var formData = $form.serializeArray(),
                            formFieldsData = {};
                        $(formData).each(function(index, obj) {
                            if (
                                obj.name != "attName" &&
                                obj.name != "attVisible" &&
                                obj.name != "attValue"
                            ) {
                                formFieldsData[obj.name] = obj.value;
                            }
                        });
                        var attsArray = [];
                        $(".ecommerce-attribute-row").each(function() {
                            var $row = $(this);
                            attsArray.push({
                                attName: $row.find('input[name="attName"]').val(),
                                attVisible: $row
                                    .find('input[name="attVisible"]')
                                    .is(":checked") ?
                                    true : false,
                                attValue: $row.find('textarea[name="attValue"]').val(),
                            });
                        });
                        if (attsArray.length > 0) {
                            formFieldsData.atts = attsArray;
                        }
                        if ($("#dropzone-form-image").get(0)) {
                            var dropzoneObj = Dropzone.forElement(
                                "#dropzone-form-image"
                            );
                            if (
                                typeof dropzoneObj != "undefined" &&
                                dropzoneObj.files.length > 0
                            ) {
                                var imagesArr = [];
                                for (var i = 0; i < dropzoneObj.files.length; i++) {
                                    imagesArr.push({
                                        dataURL: dropzoneObj.files[i].dataURL,
                                        upload: dropzoneObj.files[i].upload,
                                        tmpImageName: dropzoneObj.files[i].tmp_image,
                                    });
                                }
                                formFieldsData.images = imagesArr;
                            }
                        }
                        var $submitButton = $(".submit-button"),
                            submitText = $submitButton.html();
                        $submitButton.html(
                            '<i class="bx bx-save text-4 mr-2"></i>' +
                            $submitButton.data("loading-text")
                        );
                        $.ajax({
                                url: "/admin/categories",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                                },
                                type: "POST",
                                data: formFieldsData,
                            })
                            .done(function({
                                success,
                                message
                            }) {
                                if (success) {
                                    new PNotify({
                                        title: "Success",
                                        text: message,
                                        type: "success",
                                        addclass: "notification-success",
                                        icon: "fas fa-check",
                                    });
                                    $(".action-buttons").remove();
                                    if (
                                        $form
                                        .closest(
                                            ".ecommerce-form-sidebar-overlay-wrapper"
                                        )
                                        .get(0)
                                    ) {
                                        $(
                                            ".ecommerce-form-sidebar-overlay-wrapper"
                                        ).removeClass("show");
                                    } else {
                                        setTimeout(function() {
                                            location.reload();
                                        }, 2000);
                                    }
                                } else {
                                    $submitButton.html(submitText);
                                    new PNotify({
                                        title: "Error",
                                        text: message,
                                        type: "error",
                                        addclass: "notification-error",
                                        icon: "fas fa-times",
                                    });
                                }

                            })
                            .fail(function() {
                                $submitButton.html(submitText);
                                new PNotify({
                                    title: "Error",
                                    text: "Unfortunately an error occurred, please try again or contact the website administrator.",
                                    type: "error",
                                    addclass: "notification-error",
                                    icon: "fas fa-times",
                                });
                            });
                    },
                });
            };
            ecommerceFormValidate();
            $(window).on("ecommerce.sidebar.overlay.show", function() {
                ecommerceFormValidate();
            });
        })(jQuery);
    </script>
@endsection

@section('main')
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong> {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
        </div>
    @endif
    <form class="ecommerce-form action-buttons-fixed" action="/admin/categories" method="POST">
        <div class="row mt-2">
            <div class="col">
                <section class="card card-modern card-big-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2-5 col-xl-1-5">
                                <i class="card-big-info-icon bx bx-camera"></i>
                                <h2 class="card-big-info-title">Category Image</h2>
                                <p class="card-big-info-desc">Upload your category image</p>
                            </div>
                            <div class="col-lg-3-5 col-xl-4-5">
                                <div class="form-group row align-items-center">
                                    <div class="col">
                                        <div id="dropzone-form-image" class="dropzone-modern dz-square">
                                            <span class="dropzone-upload-message text-center">
                                                <i class="bx bxs-cloud-upload"></i>
                                                <b class="text-color-primary">Drag/Upload</b> your image here.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <section class="card card-modern card-big-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2-5 col-xl-1-5">
                                <i class="card-big-info-icon bx bx-slider"></i>
                                <h2 class="card-big-info-title">Category Details</h2>
                            </div>
                            <div class="col-lg-3-5 col-xl-4-5">
                                <div class="form-group row align-items-center mb-3">
                                    <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Category Name</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <input type="text" class="form-control form-control-modern" name="name"
                                            value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row action-buttons">
            <div class="col-12 col-md-auto">
                <button type="submit"
                    class="submit-button btn btn-primary btn-px-4 py-3 d-flex align-items-center font-weight-semibold line-height-1"
                    data-loading-text="Loading...">
                    <i class="bx bx-save text-4 me-2"></i> Save Category
                </button>
            </div>
            <div class="col-12 col-md-auto px-md-0 mt-3 mt-md-0">
                <a href="/admin/categories"
                    class="cancel-button btn btn-light btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">Cancel</a>
            </div>
        </div>
    </form>
@endsection
