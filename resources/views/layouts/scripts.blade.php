<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-0 footer-left">
            <p class="mb-0">Copyright © 2023 PIF. All rights reserved.</p>
            </div>
            <div class="col-md-6 p-0 footer-right">
            <p class="mb-0">Developed by <a href="mailto:nikola@herl.network">herl.network</a></p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
</div>
<script src="/assets/js/jquery-3.6.0.min.js"></script>
<!-- Bootstrap js-->
<script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- feather icon js-->
<script src="/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- scrollbar js-->
<script src="/assets/js/scrollbar/simplebar.js"></script>
<script src="/assets/js/scrollbar/custom.js"></script>
<!-- Sidebar jquery-->
<script src="/assets/js/config.js"></script>
<script src="/assets/js/sidebar-menu.js"></script>
<!-- Template js-->
<script src="/assets/js/script.js"></script>
<script src="/assets/js/serializeObject.js"></script>

{{-- <script src="/assets/js/theme-customizer/customizer.js">  </script> --}}

<script src="/assets/js/notify/bootstrap-notify.min.js"></script>
<script src="/assets/js/notify/notify-script.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" type="text/javascript"></script>


<script>
$(".toggle-sidebar.icon-box-sidebar").on("click",function(e){
  let date = new Date();
    date.setTime(date.getTime() + (180000 * 1000));
    let cookie = jQuery.cookie('sidebar');
    console.log(cookie);
    if(cookie == 1){
      jQuery.cookie('sidebar', 0, {
      expires: 1
    });
    }else{
      jQuery.cookie('sidebar', 1, {
      expires: date
    });
    };
});
  $(document).on("change","#languageSwitcher",function(e){
    let that = $(this);
    let lang = that.val();
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('input[name="_token"]').val()
      }
      });
      $.ajax({
        url: "/locale/"+lang,
        method: 'get',
        data: {},
        cache: false,
        success: function(data){
          location.reload();
          
        },
        error: function(data){
          notify(data.responseJSON.message,"Greska","danger");
        }

        });
  });
  function countMax(element,target){
    var vezbaChar;
    var vezba = $(element);

    var max = 0;
    vezba.each(function() {
        vezbaChar = getLastNumber($(this).attr(target));
        max       = Math.max(vezbaChar, max);
    });
    return max;
  }
function getLastNumber(string){
  var f = string.match(/\d+/);
  return parseInt(f);
}

  function notify(text=null,title,type="success"){
    $.notify({
            title: title,
            message: text
        },
        {
        type: type,
        allow_dismiss:true,
        newest_on_top:false ,
        mouse_over:false,
        showProgressbar:false,
        spacing:10,
        timer:2000,
        placement:{
            from:'top',
            align:'right'
        },
        offset:{
            x:30,
            y:30
        },
        delay:1000 ,
        z_index:10000,
        animate:{
            enter:'animated bounceInRight',
            exit:'animated bounceOutRight'
        }
    });
  }
    @if(session()->has('success'))
      notify("{{session()->get('success')}}","Uspesno");
    @endif

    @if($errors->any())
      @foreach ($errors->all() as $error)
        notify("'{{$error}}','Greska','danger");
      @endforeach
    @endif
  </script>

@if(Route::currentRouteName() == "userEdit" || Route::currentRouteName() == "userAdd")
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$("#generate").on("click",function(e){
  randomstring = Math.random().toString(36).slice(-10);
  randomstring += Math.random().toString(36).slice(-10);
  $("#password").val(randomstring);
});
$(".select2Multi").select2();

</script>
@endif

@if(Route::currentRouteName() == "home")
@role("company")
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script>
var table = $('#products_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{ route('clientProductsGet') }}",
          dataSrc: function ( d ) {
            return d.data;
          }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'company', name: 'company'},
            {data: 'action', name: 'action', orderable: false},
        ],
        
    });
  </script>
  @endrole
  @endif

@if(Route::currentRouteName() == "users")
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script>
var table = $('#users_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{ route('usersGet') }}",
          dataSrc: function ( d ) {
            return d.data;
          }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'companies', name: 'companies'},
            {data: 'action', name: 'action', orderable: false},
        ],
        
    });
  </script>
  @endif

@if(Route::currentRouteName() == "mixtures")
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script>
var table = $('#mixtures_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{ route('mixturesAll') }}",
          dataSrc: function ( d ) {
            console.log(d);
            return d.data;
          }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'trade_name', name: 'trade_name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false},
        ],
        
    });
  </script>
  @endif
@if(Route::currentRouteName() == "products")
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>

<script>
var table = $('#products_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{ route('productsGet') }}",
          dataSrc: function ( d ) {
            console.log(d);
            return d.data;
          }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'version', name: 'version'},
            {data: 'company', name: 'company_id'},
            {data: 'category', name: 'category'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false},
        ],
        
    });

    
$(document).on("click",".replicate",function(e){
  let that = $(this);
  e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: that.find("a").attr("href"),
      method: 'get',
      data: {},
      cache: false,
      success: function(data){
        $('#products_table').DataTable().ajax.reload(null,false);
      },
      error: function(data){
        notify(data.responseJSON.message,"Greska","danger");
      }

      });
})
    
</script>
@endif
@if(Route::currentRouteName() == "mixturesAddIndex" || Route::currentRouteName() == "mixturesEditIndex")

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="/assets/js/form-validation-custom.js"></script>
@include("layouts.math.functions")
<script>

$(".select2Multi").select2();
</script>
@endif
@if(Route::currentRouteName() == "productsAddIndex" || Route::currentRouteName() == "productsEditIndex")
<script src="/assets/js/form-validation-custom.js"></script>
<script src="/assets/js/editor/summernote/summernote.js"></script>
<script src="/assets/js/dropzone/dropzone.js"></script>
<script src="/assets/js/jquery.ui.min.js"></script>
<script src="/assets/js/dragable/sortable.js"></script>
<script type="text/javascript">// Immediately after the js include
  Dropzone.autoDiscover = false;
</script>
<script>
(function($) {
  "use strict";
})(jQuery);
  $( function() {
    $( ".parentClone" ).sortable({
      revert: true,
      animation:150,
      handle: '.handle',
      axis: "y",
      change: function(event, ui) {
      ui.placeholder.css({visibility: 'visible', border : '1px solid #ccc'});
    }
    });
  }); 
  </script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@include("layouts.math.functions")

<script>
 
  @if(Route::currentRouteName() == "productsEditIndex")
  $(".cst_buttons .download_button").on("click",function(e){
    let that = $(this);
    e.preventDefault();
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
  });
  $.ajax({
    url: '{{route("pdfGenerate",$product->id)}}',
    type: 'get',
    data: {},
    cache: false,
    success: function(data){
      window.location="https://app.hammock.rs/product/pdf/generate/"+{{$product->id}};
      if(that.text() == "PDF Generate"){
        that.text("PDF Download")
      }
    },
    beforeSend: function(){
      $("body").prepend('<div class="loader-wrapper"><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"> </div><div class="dot"></div></div>');
    },
    error: function(data){
      notify(data.responseJSON.message,"Greska","danger");
    },
    complete: function(){
      $("body .loader-wrapper").remove();
    },
  });
  });
@endif
$(document).on("change","#product_image",function(e){
    let that    = $(this);
    let preview = $("#product_image_preview");
    preview.val(readURL(this));
  });
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#product_image_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
  




$(document).ready(function() {
 $('.multiFileUpload').each(function(i, el){
  let that = $(this);
  that.dropzone({
    @if(Route::currentRouteName() == "productsEditIndex")
    init: function() { 
      var myDropzone = this;
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
        });
      $.ajax({
        url: '{{route("aneksFetch")}}',
        type: 'post',
        data: {product_id: $("#product_id").val(), type:that.attr("type")},
        dataType: 'json',
        success: function(response){
          $.each(response, function(key,value) {
            var mockFile = { name: value.name, size: value.size, data_link: value.path};
            myDropzone.emit("addedfile", mockFile);
            myDropzone.emit("thumbnail", mockFile, "/icon.png");
            myDropzone.emit("complete", mockFile);

  
          });
  
        }
      });
    },
    @endif
      removedfile: function(file) {
        let img_src = file.data_link;
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
        });
        $.ajax({
          url: "{{route('aneksRemove')}}",
          method: 'post',
          data: {file:img_src},
          cache: false,
          success: function(data){
            $('#aneksi input[value="'+data+'"]').remove();
            notify("Uspesno ste obrisali","Uspesno");
            $('.lista_fajlova li a[href*="'+data+'"]').parent().remove();
          },
          error: function(data){
            notify(data,"Greska","danger");
          }

          });
          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        
        },
      url: "{{route('aneksUpload')}}",
      addRemoveLinks: true,
      method: "POST",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (file, response) {
          let code = that.attr("type");
          var imgName = response;
          file.name = response;
          file.previewElement.classList.add("dz-success");
          var fileuploded = file.previewElement.querySelector("[data-dz-name]");
          file.previewElement.querySelector("img").src = "/icon.png";
          file.data_link = response;
          var filename = response.split('/').pop();
          $("#aneksi").append("<input type='hidden' name='aneksi["+code+"][]' value='"+response+"'>");
          $(".lf_"+code).append("<li><a href="+response+" target='_blank'>"+filename+"</a></li>");
          
      },
      error: function (file, response) {
          file.previewElement.classList.add("dz-error");
      }
  });
})
$(document).on("change",".selectLocale",function(e){
  let lang = $(this).val();
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '/locale/'+lang,
      method: 'get',
      data: {},
      cache: false,
      success: function(data){
        location.reload();
      },
      error: function(data){
        notify(data.responseJSON.message,"Greska","danger");
      }

      });
});
$(".select2Multi").select2();
@if(Route::currentRouteName() == "productsAddIndex")
$(".select2Multi").val("")
$(".select2Multi").trigger("change");
@endif



  $(document).on("click",".addMore",function(e){
    $(".select2Multi").select2('destroy');
    e.preventDefault();
    var that    = $(this);
    let parent  = that.closest(".parentClone");
    let child   = parent.find(".canClone");
    let child_f = parent.find(".canClone:last");
    let clone   = child_f.clone();
    let count   = countMax(child,"data_id");
    let cloneId = clone.attr("data_id");
    count++;
    // obrisi val
    clone.find("input").val("");
    clone.find("textarea").val("");
    // zameni ID u klona
    clone.find('.form-input-replace[name*='+cloneId+']').attr('name', function(_, name){
      return name.replace('['+cloneId+']', '['+count+']')
    });
    clone.removeClass('mixture-'+cloneId).addClass('mixture-'+count);

    clone.find('.form-input-replace[name*='+cloneId+']').attr('name', function(_, name){
      return name.replace('['+cloneId+']', '['+count+']')
    });
    clone.find('.form-input-replace').attr('id', function(_, name){
      return name.replace('['+cloneId+']', '['+count+']')
    });
    //   clone.find('textarea.form-control').attr('id', function(_, name){
    //   return name.replace('['+cloneId+']', '['+count+']')
    // });
    clone.find('label').attr('for', function(_, name){
      return name.replace('['+cloneId+']', '['+count+']')
    }); 
    // nov ID
    clone.attr("data_id",count);
    clone.insertAfter(child_f);
    clone.find(".select2Multi option:selected").removeAttr("selected");
    clone.find(".dobavljac").val(clone.find(".dobavljac option:first-child"));
    $(".select2Multi").select2();
    clone.find(".iu_check").attr("checked","checked");
    clone.find(".select2Multi").val("");
    clone.find(".select2Multi").trigger("change");
    

});

function getData(data){
 let object = data;
 return object;
}






$.fn.serializeControls = function() {
  var data = {};

  function buildInputObject(arr, val) {
    if (arr.length < 1)
      return val;  
    var objkey = arr[0];
    if (objkey.slice(-1) == "]") {
      objkey = objkey.slice(0,-1);
    }  
    var result = {};
    if (arr.length == 1){
      result[objkey] = val;
    } else {
      arr.shift();
      var nestedVal = buildInputObject(arr,val);
      result[objkey] = nestedVal;
    }
    return result;
  }

  $.each(this.serializeArray(), function() {
    var val = this.value;
    var c = this.name.split("[");
    var a = buildInputObject(c, val);
    $.extend(true, data, a);
  });
  
  return data;
}
var path = "{{ route('mixturesGet') }}";
  
    $('#mixtureSelect').select2({
        dropdownParent: $('#loadMixtureModal'),
        placeholder: 'Select a mixture',
        ajax: {
          url: path,
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.trade_name,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
      });
$(document).on("click",".loadMixture",function(e){
  let that       = $(this);
  let parent     = $(".parentClone");
  let child      = parent.find(".canClone"); 
  let child_last = parent.find(".canClone:last"); 
  let data_index = child_last.attr("data_index");
  let chapter_id = child_last.attr("chapter_id");
  let id         = countMax(child,"data_id");;
  let mixture_id = $("#mixtureSelect").val();
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("mixtureRender")}}',
      method: 'POST',
      data: {id:id,data_index:data_index,chapter_id:chapter_id,mixture_id:mixture_id},
      cache: false,
      success: function(response){
        console.log(response);
        if(response.error){
          return notify(response.error,"Greska","danger");
        }
        child_last.after(response.heading);
        $("#tradeList").append(response.body)
        parent.find(".canClone:last").find("select").select2();
        return notify("Uspesno ucitano","Uspesno");
      },
      error: function(response){
        notify(response.error,"Greska","danger");
      },
      complete: function(response){
      }

      });
});


$(document).on("click",".saveMixture",function(e){
  let that       = $(this);
  let parent     = that.closest(".canClone");
  let data_index = parent.attr("data_index");
  let id         = parent.attr("data_id");
  let chapter_id = parent.attr("chapter_id");
  let name       = "items[id-"+data_index+"][data][content]["+id+"]";
  let content    = $('[name^="'+name+'"]');
  let mixt_el    = $(".mixture-"+id);
  let ingr_el    = $(".card_"+id);

  let mixt = $(".mixture-"+id).wrapAll("<form class='forms formMixture_"+id+"'></form>");
  let ingr = $(".card_"+id).wrapAll("<form class='forms form_"+id+"'></form>");


  let data1 = $(".form_"+id).serializeControls()['items']['id-'+data_index]['data']['content'][id]; 
  let data2 = $(".formMixture_"+id).serializeControls()['items']['id-'+data_index]['data']['content'][id];


  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("mixtureSave")}}',
      method: 'POST',
      data: {ingredients:data1,mixture:data2},
      cache: false,
      success: function(response){
        console.log(response);
        if(response.error){
          return notify(response.error,"Greska","danger");
        }
        notify(response.success,"Uspesno");
      },
      error: function(response){
        notify(response.error,"Greska","danger");
      },
      complete: function(response){
        mixt.unwrap();
        ingr.unwrap();
      }

      });
});

$(document).on("click",".removeItem",function(e){
    e.preventDefault();
    var that    = $(this);
    let div     = that.closest(".parentClone");
    let parent  = that.closest(".canClone");
    let id      = parent.attr("data_id");
    if(div.find(".canClone").length > 1){
        $(".inci_p_"+id).closest(".card").remove();
        that.closest(".canClone").remove();
    }
});

    $('.editorMDE').summernote({
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['table',['table']],
          ['mybutton', ['productName','productVersion','productFormula','productCategory']],
          // ['new', ['formula','koncentracija','sed','noael','mos','dermalna_apsorpcija','dermalna_apsorpcija_procenti','ssa','fappl']]
        ],
        followingToolbar: false,
        buttons: {
          productVersion: productVersion,
          productName: productName,
          productFormula: productFormula,
          productCategory: productCategory,
          // formula: formula,
          // koncentracija: koncentracija,
          // sed: sed,
          // noael: noael,
          // mos: mos,
          // dermalna_apsorpcija: dermalna_apsorpcija,
          // dermalna_apsorpcija_procenti: dermalna_apsorpcija_procenti,
          // ssa: ssa,
          // fappl: fappl,
        },
        height: 250,
    });
});

</script>
@include("layouts.textarea.buttons")
@endif

@if(Route::currentRouteName() == "ingredientsAddIndex" || Route::currentRouteName() == "ingredientsEditIndex")
<script src="/assets/js/form-validation-custom.js"></script>


<script src="/assets/js/editor/summernote/summernote.js"></script>
<script>

$(document).on("click",".addMore",function(e){
    e.preventDefault();
    var that    = $(this);
    let parent  = that.closest(".parentClone");
    let child   = parent.find(".canClone");
    let child_f = parent.find(".canClone:last");
    let clone   = child_f.clone();
    let count   = countMax(child,"data_id");
    let cloneId = clone.attr("data_id");
    count++;
    // obrisi val
    clone.find("input").val("");
    clone.find("textarea").val("");
    // zameni ID u klona
    clone.find('input[name*='+cloneId+']').attr('name', function(_, name){
      return name.replace('['+cloneId+']', '['+count+']')
    });
    clone.find('textarea[name*='+cloneId+']').attr('name', function(_, name){
      return name.replace('['+cloneId+']', '['+count+']')
    });
    clone.find('input').attr('id', function(_, name){
      return name.replace('['+cloneId+']', '['+count+']')
    });
    clone.find('textarea').attr('id', function(_, name){
      return name.replace('['+cloneId+']', '['+count+']')
    });
    clone.find('label').attr('for', function(_, name){
      return name.replace('['+cloneId+']', '['+count+']')
    }); 
    // nov ID
    clone.attr("data_id",count);
    clone.insertAfter(child_f);
});
    
$(document).on("click",".removeItem",function(e){
    e.preventDefault();
    var that    = $(this);
    let parent  = that.closest(".parentClone");
    let child   = parent.find(".canClone");
    let child_f = parent.find(".canClone:last");
    if(child.length > 1){
        that.closest(".canClone").remove();
    }
});
$(document).ready(function() {
    $('.editorMDE').summernote({
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
        ],
        height: 250,
    });
});
// $('textarea.').each(function() {
//     var simplemde = new SimpleMDE({
//         element: this,
//         toolbar: ["bold", "italic"],
//         spellChecker: false,
        
//     });
//     simplemde.render(); 
// })
// (function($) {
    
//     var simplemde = new SimpleMDE({
//         element: $("textarea")
//     });
//     toolbarInitialTop = $('.editor-toolbar').offset().top;
//     toolbarOuterHeight = $('.editor-toolbar').outerHeight();
//     toolbarFixedTop = 0;
//     cmPaperTop = toolbarFixedTop + toolbarOuterHeight;
//     toolbarAffixAt = toolbarInitialTop - toolbarFixedTop;
//     $(document).scroll(fnAffix);
//     $(document).resize(fnSetWidth);
//     function fnAffix() {
//         if ($(document).scrollTop() > toolbarAffixAt) {
//             $('.editor-toolbar').addClass('toolbar-fixed');
//             $('.editor-toolbar').css({'top': toolbarFixedTop + 'px'});
//             $('.CodeMirror.cm-s-paper.CodeMirror-wrap').css({'top': cmPaperTop + 'px'});
//             fnSetWidth();
//         }else {
//             $('.editor-toolbar').removeClass('toolbar-fixed');
//             $('.CodeMirror.cm-s-paper.CodeMirror-wrap').css({'top': ''});
//         }
//     }
//     function fnSetWidth() {
//         // Adjust fixed toolbar width to the width of CodeMirror
//         $('.toolbar-fixed').width($('.CodeMirror.cm-s-paper.CodeMirror-wrap').width());
//     }
// })(jQuery);
</script>
@endif

@if(Route::currentRouteName() == "ingredients")

<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
  $('#basic-1').DataTable();    
});
</script>

@endif


@if(Route::currentRouteName() == "chapters")
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/editor/summernote/summernote.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.3.2/js/dataTables.rowReorder.min.js"></script>


<script>

$(document).ready(function() {
    var editor = $('.chapter_content').summernote({
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['table',['table']],
          ['mybutton', ['productName','productVersion','productFormula','productCategory']]
        ],
        buttons: {
          productVersion: productVersion,
          productName: productName,
          productFormula: productFormula,
          productCategory: productCategory,
        },
        height: 250,
        followingToolbar: false,
        callbacks: {
        // onInit: function(e) {
        //   $(this).summernote("code", sessionStorage.getItem("summernotedata"));
        // },
        // onChange: function(contents, $editable) {
        //   sessionStorage.setItem("summernotedata", $(this).summernote("code"));
        // },
        onPaste: function (e) {
          var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
          e.preventDefault();
          document.execCommand('insertText', false, bufferText);
      }
      }
        
    });
});

var table = $('#chapter_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{ route('chaptersGet') }}",
          dataSrc: function ( d ) {
            return d.data;
          }
        },
        ordering: true,
        columns: [
            {data: 'order_number', name: 'order_number', defaultContent: '0'},
            {data: 'name_{{session()->get("locale")}}', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
            { orderable: false, }
        ],
        // rowReorder: { dataSrc: 'order_number' },
        
    });
  //   table.on( 'pre-row-reorder', function ( e, node, index ) {
  //   originalIndex = node.index;
  // } );

  // table.on( 'row-reordered', function ( e, diff, edit ) {
  //   let rowData = [];
  //   for (var i = 0, ien = diff.length; i < ien; i++) {
  //     console.log(table.row(diff[i].node).data());
  //     rowData.push(table.row(diff[i].node).data());

  //     rowData[i].order = diff[i].newData;
  //   }
  //   console.log(rowData);
  //   return rowData;
  // } );


    // table.on('row-reordered', function (e, diff, edit) { 
    //   table.one('draw', function () {
    //   var DATA = [];
    //   for (var i = 0, ien = diff.length; i < ien; i++) {
    //     DATA.push({ old_position: diff[i].oldPosition, new_position: diff[i].newPosition});
    //   };
    //   DATA = JSON.stringify(DATA)
    //   $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('input[name="_token"]').val()
    //     }
    // });
    //   $.ajax({
    //     url: '{{route("chapterRowUpdate")}}',
    //     method: 'POST',
    //     data: {data:DATA},
    //     cache: false,
    //     success: function(data){
    //       console.log(data);
    //       $('#chapter_table').DataTable().ajax.reload();
    //       notify("Uspesno ste izmenili podatak!","Uspesno");
    //     },
    //     error: function(data){
    //     }

    //   });

    // });
    // });
  // $('#chapter_table').DataTable({
  //   'processing': true,
  //   'serverSide': true,
  //   // paging: false,
  //   // ordering: true,
  //   // info: false,
  //   // searching: false,
  //   'ajax': '{{route("chaptersGet")}}',
  //   'columns': [
  //        { data: 'id' },
  //        { data: 'name' },
  //        { data: 'content' },
  //        { data: 'action' },
  //     ]
  //   });

  $(document).on("submit",".chapter_edit_form",function(e){
    let form = $(this).serializeObject();
    e.preventDefault();
    let id      = $("#chapter_id").val();
    let name    = $("#chapter_name").val();
    let content = $("#chapter_content").val();
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("chapterSave")}}',
      method: 'POST',
      data: form,
      cache: false,
      success: function(data){
        console.log(data);
        $('#chapter_table').DataTable().ajax.reload(null,false);
        notify("Uspesno ste izmenili podatak!","Uspesno");
      },
      error: function(data){
        notify(data.responseJSON.message,"Greska","danger");
      }

      });
  });
  $(document).on("click",".edit",function(e){
    let id     = $(this).attr("data_id");
    let locale = "{{session()->get('locale')}}";
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("chapterGet")}}',
      method: 'POST',
      data: {id:id,locale:locale},
      cache: false,
      success: function(data){
      //   $("body, html").animate({
      //     scrollTop: $("#chapter_edit_form").offset().top
      // }, 500);
        $(".chapter_id").val(data.id);
        $("#chapter_name_sr").val(data.name_sr);
        $("#chapter_name_en").val(data.name_en);
        let json = JSON.parse(data.content_sr);
        let json2 = JSON.parse(data.content_en);
        if(json==null){
            $("#chapter_content_sr").text("");
            $('#chapter_content_sr').summernote('code', "");
        }else{
          $.each(json,function(k,v){
          if(v.type == "texteditor"){  
            $("#chapter_content_sr").text(v.data);
            $('#chapter_content_sr').summernote('code', v.data);
          };
        });
        }
        if(json2==null){
            $("#chapter_content_en").text("");
            $('#chapter_content_en').summernote('code', "");
        }else{
          $.each(json2,function(k,v){
          if(v.type == "texteditor"){  
            $("#chapter_content_en").text(v.data);
            $('#chapter_content_en').summernote('code', v.data);
          };
        });
        }


      },
      error: function(data){
      }

      });
});
</script>

@include("layouts.textarea.buttons")

@endif








@if(Route::currentRouteName() == "manufacturers")
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/sweet-alert/sweetalert.min.js"></script>

<script>
  var table = $('#manufacturer_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('manufacturersGet') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $(document).on("click",".edit",function(e){
    let id = $(this).attr("data_id");
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("manufacturerGet")}}',
      method: 'POST',
      data: {id:id},
      cache: false,
      success: function(data){
        $("body, html").animate({
          scrollTop: $("#manufacturer_form").offset().top
      }, 500);
      $("#manufacturer_id").val(data.id);
      $("#manufacturer_name").val(data.name);
      },
      error: function(data){
      }

      });
});
$(document).on("click","#manufacturer_form button",function(e){
  let attr = $(this).attr("saveasnew");
  if (typeof attr !== 'undefined' && attr !== false) {
    $("#manufacturer_id").val("");
  }
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("manufacturersSave")}}',
      method: 'POST',
      data: $("#manufacturer_form").serialize(),
      proccessData: false,
      success: function(data){
        if (typeof attr !== 'undefined' && attr !== false) {
          $("#manufacturer_id").val(data.id);
        }
        $('#manufacturer_table').DataTable().ajax.reload();
        notify("Uspesno ste izmenili podatak!","Uspesno");
      },
      error: function(data){
      }

      });
  });

  $(document).on("click",".delete",function(e){
    let that = $(this);
    swal({
      title: "Jesi li siguran?",
      text: "Ukoliko obrises, podatak ce biti zauvek obrisan.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
      if (willDelete) {
        let id = that.attr("data_id");
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("manufacturersDelete")}}',
      method: 'POST',
      data: {id:id},
      proccessData: false,
      success: function(data){
        $('#manufacturer_table').DataTable().ajax.reload();
      },
      error: function(data){
      }

      });
          swal("Podatak uspesno obrisan", {
              icon: "success",
          });
      } 
  })
  })
</script>
@endif

@if(Route::currentRouteName() == "companies")
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/sweet-alert/sweetalert.min.js"></script>

<script>
  var table = $('#company_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('companiesGet') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'long_name', name: 'long_name'},
            {data: 'address', name: 'address'},
            {data: 'pib', name: 'pib'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $(document).on("click",".edit",function(e){
    let id = $(this).attr("data_id");
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("companyGet")}}',
      method: 'POST',
      data: {id:id},
      cache: false,
      success: function(data){
        $("body, html").animate({
          scrollTop: $("#company_form").offset().top
      }, 500);
      $("#company_id").val(data.id);
      $("#company_name").val(data.name);
      $("#company_responsible_person").val(data.responsible_person);
      $("#company_email").val(data.email);
      $("#company_phone").val(data.phone);
      $("#company_address").val(data.address);
      $("#company_pib").val(data.pib);
      $("#company_id_number").val(data.id_numbers);
      $("#company_contact_phone").val(data.company_phone);
      },
      error: function(data){
      }

      });
});
$(document).on("click","#company_form button",function(e){
  let attr = $(this).attr("saveasnew");
  if (typeof attr !== 'undefined' && attr !== false) {
    $("#company_id").val("");
  }
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("companiesSave")}}',
      method: 'POST',
      data: $("#company_form").serialize(),
      proccessData: false,
      success: function(data){
        if (typeof attr !== 'undefined' && attr !== false) {
          $("#company_id").val(data.id);
        }
        $('#company_table').DataTable().ajax.reload();
        notify("Uspesno ste izmenili podatak!","Uspesno");
      },
      error: function(data){
      }

      });
  });

  $(document).on("click",".delete",function(e){
    let that = $(this);
    swal({
      title: "Jesi li siguran?",
      text: "Ukoliko obrises, podatak ce biti zauvek obrisan.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
      if (willDelete) {
        let id = that.attr("data_id");
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("companiesDelete")}}',
      method: 'POST',
      data: {id:id},
      proccessData: false,
      success: function(data){
        $('#company_table').DataTable().ajax.reload();
      },
      error: function(data){
      }

      });
          swal("Podatak uspesno obrisan", {
              icon: "success",
          });
      } 
  })
  })
</script>
@endif

@if(Route::currentRouteName() == "distributors")
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/sweet-alert/sweetalert.min.js"></script>

<script>
  var table = $('#distributor_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('distributorsGet') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $(document).on("click",".edit",function(e){
    let id = $(this).attr("data_id");
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("distributorGet")}}',
      method: 'POST',
      data: {id:id},
      cache: false,
      success: function(data){
        $("body, html").animate({
          scrollTop: $("#distributor_form").offset().top
      }, 500);
      $("#distributor_id").val(data.id);
      $("#distributor_name").val(data.name);
      },
      error: function(data){
      }

      });
});
$(document).on("click","#distributor_form button",function(e){
  let attr = $(this).attr("saveasnew");
  if (typeof attr !== 'undefined' && attr !== false) {
    $("#distributor_id").val("");
  }
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("distributorsSave")}}',
      method: 'POST',
      data: $("#distributor_form").serialize(),
      proccessData: false,
      success: function(data){
        if (typeof attr !== 'undefined' && attr !== false) {
          $("#distributor_id").val(data.id);
        }
        $('#distributor_table').DataTable().ajax.reload();
        notify("Uspesno ste izmenili podatak!","Uspesno");
      },
      error: function(data){
      }

      });
  });

  $(document).on("click",".delete",function(e){
    let that = $(this);
    swal({
      title: "Jesi li siguran?",
      text: "Ukoliko obrises, podatak ce biti zauvek obrisan.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
      if (willDelete) {
        let id = that.attr("data_id");
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("distributorsDelete")}}',
      method: 'POST',
      data: {id:id},
      proccessData: false,
      success: function(data){
        $('#distributor_table').DataTable().ajax.reload();
      },
      error: function(data){
      }

      });
          swal("Podatak uspesno obrisan", {
              icon: "success",
          });
      } 
  })
  })
</script>
@endif