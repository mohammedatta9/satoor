@extends('layouts.dash_master')
@section('title')
<title>{{__('dash.Create Product')}}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('dash.Create Product')}}</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('user.product.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('dash.Products')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >{{__('dash.Icon')}} <span class="text-danger">*</span></label>
                                        <input type='file' onchange="loadFile_image(icon)" name="icon" id="icon"
                                                class="@error('icon') is-invalid @enderror"
                                                style="display:none;"/>
                                        <button id="output_icon" type="button"
                                                onclick="document.getElementById('icon').click();" value="emad"
                                                style="
                                                    width: 150px;
                                                    height: 150px;
                                                    border-radius: 5%;
                                                    background: #cecbcb;
                                                    background-image: url({{ asset('storage/file-upload.jpg' ) }});
                                                    background-repeat: no-repeat;
                                                    background-size: cover;
                                                    background-position: center;
                                                    "/>
                                    </div>
                                </div>
                                <script>
                                var loadFile_image = function (image) {
                                    var image = document.getElementById('output_icon');
                                    var src = URL.createObjectURL(event.target.files[0]);
                                    image.style.backgroundImage = 'url(' + src + ')';
                                };
                                </script>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{__('dash.Status')}} <span class="text-danger">*</span></label>
                                        <input id="status_toggle" value="1" name="status" type="checkbox" checked data-toggle="toggle" data-on="{{__('dash.Active')}}" data-off="{{__('dash.Inactive')}}" data-onstyle="success" data-offstyle="danger">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('dash.Category')}} <span class="text-danger">*</span></label>
                                        <select name="category[]" multiple class="form-control select2" id="category" required >
                                            <option value="">{{__('dash.Select Category')}}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group col-6">
                                    <label>{{__('dash.Name')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name" value="{{ old('name') }}" required maxlength="200">
                                </div>
                                <div class="form-group col-6">
                                    <label>{{__('dash.Name_en')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name_en" class="form-control"  name="name_en" value="{{ old('name_en') }}" required maxlength="200">
                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('dash.price')}} <span class="text-danger">*</span></label>
                                   <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" required maxlength="200">
                                </div>
                                <div class="form-group col-6">
                                    <label>{{__('dash.price_sale')}} </label>
                                   <input type="number" class="form-control" name="price_sale" id="price_sale" value="{{ old('price_sale') }}" maxlength="200">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('dash.Description')}} <span class="text-danger">*</span></label>
                                    <textarea name="description" id="" cols="30" rows="10" class="summernote">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('dash.Description_en')}} <span class="text-danger">*</span></label>
                                    <textarea name="description_en" id="description_en" cols="30" rows="10" class="summernote">{{ old('description_en') }}</textarea>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('dash.Tags')}}  ({{__('dash.Press the comma for new tag')}})</label> <br>
                                   <input type="text" class="form-control" data-role="tagsinput" maxlength="500" name="tags" value="{{ old('tags') }}" >
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('dash.Images')}}</label>
                                    <div class="upload__box">
                                        <div class="upload__btn-box">
                                          <label class="upload__btn">
                                            <p>+ Upload images</p>
                                            <input type="file" multiple name="photos[]" data-max_length="20" class="upload__inputfile" >
                                          </label>
                                        </div>
                                        <div class="upload__img-wrap"></div>
                                    </div>
                                </div>

                                <div class="form-group col-6">
                                    <label>{{__('dash.Color')}}</label> <input type="checkbox" name="have_color" id="have_color" value="1" style="margin: 8px">
                                        <div id="myRepeatingFields_co" class="col-sm-9 d-none" >
                                                <div class="entry_co input-group col-xs-3">
                                                    <table class="table meeting-table class-table">
                                                        <tr>
                                                            <td><input type="color" name="color[]" /></td>
                                                            <td> <button type="button" class="btn btn-success btn-add-co">
                                                            <span class="glyphicon glyphicon-plus" aria-hidden="true">+</span>
                                                        </button></td>
                                                        </tr>
                                                    </table>
                                                    <span class="input-group-btn">
                                                    </span>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{__('dash.Sizes')}} </label>
                                        <select name="size[]" multiple class="form-control select2" id="size" >
                                            <option value="">{{__('dash.Select sizes')}}</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('dash.SEO Title')}}</label>
                                   <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title') }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('dash.SEO Description')}}</label>
                                    <textarea name="seo_description" id="" cols="30" rows="10" class="form-control text-area-5">{{ old('seo_description') }}</textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('dash.Highlight')}}</label>
                                    <div>
                                         <label for="popular_item" class="mr-3" >{{__('dash.Popular')}}</label> <input type="checkbox" name="popular_item" id="popular_item"><br>

                                         <label for="trending_item" class="mr-3" >{{__('dash.Trending')}}</label> <input type="checkbox" name="trending_item" id="trending_item">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('dash.Save')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

<script>
    (function($) {
        "use strict";
        var specification = true;
        $(document).ready(function () {
            $("#name").on("focusout",function(e){
                $("#slug").val(convertToSlug($(this).val()));
            })

            $("#download_file_type").on("change", function(){
                let currentVal = $(this).val();
                if(currentVal == 'direct_upload'){
                    $(".upload_file_box").removeClass('d-none')
                    $(".download_link_box").addClass('d-none')
                }else{
                    $(".upload_file_box").addClass('d-none')
                    $(".download_link_box").removeClass('d-none')
                }
            })
            $("#have_color").on("change", function(){
                if($(this).is(':checked')){
                    $("#myRepeatingFields_co").removeClass('d-none')
                }else{
                    $("#myRepeatingFields_co").addClass('d-none')
                }
            })
        });
    })(jQuery);


    function convertToSlug(Text){
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-');
    }

    jQuery(document).ready(function () {
  ImgUpload();
});

function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });

  $('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    for (var i = 0; i < imgArray.length; i++) {
      if (imgArray[i].name === file) {
        imgArray.splice(i, 1);
        break;
      }
    }
    $(this).parent().parent().remove();
  });
}


$(function () {
       $(document)
           .on("click", ".btn-add-co", function (e) {
               e.preventDefault();
               var controlForm = $("#myRepeatingFields_co:first"),
                   currentEntry = $(this).parents(".entry_co:first"),
                   newEntry = $(currentEntry.clone()).appendTo(controlForm);
               newEntry.find("input").val("");
               controlForm.find(".entry_co:not(:last) .btn-add-co").removeClass("btn-add-co").addClass("btn-remove-co").removeClass("btn-success").addClass("btn-danger").html("-");
           })
           .on("click", ".btn-remove-co", function (e) {
               e.preventDefault();
               $(this).parents(".entry_co:first").remove();
               return false;
           });
   });
</script>

@endsection
