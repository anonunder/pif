<script>
    
  function conc_sum(element){
    let parent = element.closest(".card");
    let concs  = parent.find(".conc_value");
    let sum    = 0;
    $.each(concs,function(){
      if($(this).val() != ""){
      sum += parseFloat($(this).val());
      }
    });
    parent.find(".all_conc").text(sum + "%");
  }

  function mosCalc(element){
    let parent = element.closest(".trade_li");
    let sed    = parent.find(".sed_value");
    let noael  = parent.find(".noael_value");
    let sum    = noael.val()/sed.val();
    let mos    = parent.find(".mos_value");
    if(sed.val() == "" || noael.val() == ""){
        mos.val("");
    }else{
        mos.val(sum.toFixed(2));
    }
}
$(document).on("input", ".main_conc",function(e){
    let that      = $(this);
    let parent_id = that.closest(".canClone").attr("data_id");
    let element   = $('.trade_li[data_id='+parent_id+']');
    $.each(element,function(){
        sed = sedCalc($(this).find(".sedCalc").val(),$(this));
        $(this).find(".sed_value").val(sed);
        mosCalc($(this)); 
    });
    
});
  function sedCalc(formula,element){
    let a     = element.find(".a_value").val();
    let conc  = element.find(".conc_value").val();
    let da    = element.find(".da_value").val();
    let daa   = element.find(".daa_value").val();
    let ssa   = element.find(".ssa_value").val();
    let fappl = element.find(".fappl_value").val();
    let s     = conc.split("-");
    let big   = Math.max.apply( null, s );
    let ch_id = element.closest(".trade_li").attr("data_id");
    let m_con = $('.canClone[data_id='+ch_id+']').find(".main_conc").val();
    let diff  = m_con / 100 * big;

    // big       =
    // let sed   = element.find(".sed_value").val();
    let n_sed = "";
    if(formula == "A(mg/kgbw/day)xC(%)/100xDA(%)/100"){
      n_sed = a*diff/100*da/100;
    }
    if(formula == "DAa x10⁻³ x SSA x fappl"){
      n_sed = daa*0.001*ssa*fappl;
    }
    if(n_sed === "NaN"){
      n_sed = "";
    }
    return n_sed;
  }


  $(document).on("input", ".a_value, .conc_value, .da_value, .daa_value, .ssa_value, .fappl_value",function(e){
    let that    = $(this);
    let element = that.closest(".trade_li");
    let sed;
    sed = sedCalc(element.find(".sedCalc").val(),element);
    element.find(".sed_value").val(sed);
    mosCalc(element);
    conc_sum(that);
});
$(document).on("change",".sedCalc",function(e){
  let that    = $(this);
  let element = that.closest(".trade_li");
  let sed;
  sed = sedCalc(that.val(),element);
  element.find(".sed_value").val(sed);
  mosCalc(element);

});


$(document).on("input", ".noael_value,.sed_value",function(e){
  mosCalc($(this));
});
$(document).on("select2:unselect",".select2Multi.inci_additional", function(e) { 
  let that       = $(this);
  let id         = e.params.data.id;
  let parent     = that.closest(".canClone");
  let chapter_id = parent.attr("data_id");
  $(".inci_li_e_"+chapter_id+"_"+id).remove();
  if($(".inci_list_"+chapter_id).is(':empty')){
    $(".inci_list_"+chapter_id).closest('.card').remove();
  }

});
$(document).on("click",".referenceAdd",function(e){
    let parent = $(this).closest(".references");
    let child  = parent.find(".reference:first");
    let clone  = child.clone();
    clone.find("input").val("");
    parent.find(".reference:last").after(clone);
});
$(document).on("click",".referenceRemove",function(e){
    let parent = $(this).closest(".references");
    let child  = $(this).closest(".reference");
    console.log(parent.find('.reference').length);
    if(parent.find('.reference').length > 1){
     child.remove(); 
    }
});

$(document).on("input",".trade_name",function(e){
  let that       = $(this);
  let parent     = that.closest(".canClone");
  let chapter_id = parent.attr("data_id");
  $(".inci_p_"+chapter_id+" span").text(that.val());
});
$(document).on("select2:selecting",".select2Multi.inci_additional", function(e) { 
  let that       = $(this);
  let id         = e.params.args.data.id;
  let ingredient = ingredientGet(id);
  let locale     = "{{session()->get('locale');}}";
  let c_field    = "content_"+locale;
  let content    = JSON.parse(ingredient[c_field]);
  let noael      = "";
  let parent     = that.closest(".canClone");
  let t_name     = parent.find(".trade_name").val();
  let chapter_id = parent.attr("data_id");
  let data_text  = e.params.args.data.text;
  if(content.items.noael.noael != null){
    noael = content.items.noael.noael;
  }
  if(t_name == ""){
    t_name = data_text;
    parent.find(".trade_name").val(t_name);
  }
  let pname     = that.attr("name").slice(0,-17);
    let out = "";
    out  +='<div class="additional_ul">';
    out  +='<div class="additional_list_'+chapter_id+'">';
    out  +='<div class="row">';
    out  +='<div class="col-2 align-self-center">';
    out  +='<p>Additional</p>';
    out  +='</div>';
    out  +='<div class="col-10">';
    out  +='<div class="row">';
    out  +='<div class="col-3">Necistoce: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][necistoce]"></div>';
    out  +='<div class="col-3">Funkcija: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][funkcija]"></div>';
    out  +='<div class="col-3">Regulatorni status: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][regulatory_status]"> </div>';
    out  +='<div class="col-3">Molekulska masa (MW): <input type="text" placeholder="Text | Referenca" class="form-control " value="" name="'+pname+'[additional][molekulska_masa]"> </div>';
    out  +='<div class="col-3">Opis: <input type="text" placeholder="Text | Referenca" class="form-control " value="" name="'+pname+'[additional][opis]">  </div>';
    out  +='<div class="col-3">Log Pow: <input type="text" placeholder="Text | Referenca" class="form-control " value="" name="'+pname+'[additional][log_pow]">  </div>';
    out  +='<div class="col-3">Tacka topljenja: <input type="text" placeholder="Text | Referenca" class="form-control " value="" name="'+pname+'[additional][tacka_topljenja]">  </div>';
    out  +='<div class="col-3">Rastvorljivost: <input type="text" placeholder="Text | Referenca" class="form-control " value="" name="'+pname+'[additional][rastvorljivost]">  </div>';
    out  +='<div class="col-3">Akutna toksičnost oralno: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][akutna_toksicnost_oralno]">  </div>';
    out  +='<div class="col-3">Akutna toksičnost dermalno: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][akutna_toksicnost_dermalno]">  </div>';
    out  +='<div class="col-3">Akutna toksičnost inhalacija: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][akutna_toksicnost_inhalacija]">  </div>';
    out  +='<div class="col-3">Iritacija kože/korozija: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][iritacija_koze]">  </div>';
    out  +='<div class="col-3">Iritacija oka: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][iritacija_oka]">  </div>';
    out  +='<div class="col-3">Senzitizacija: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][senzitizacija]">  </div>';
    out  +='<div class="col-3">Hronična (ponovljena) izloženost: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][hronicna_ponovljena_izlozenost]">  </div>';
    out  +='<div class="col-3">Mutagenost/Genotoksičnost: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][mategenost_genotoksicnost]">  </div>';
    out  +='<div class="col-3">Karcinogenost: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][karcinogenost]">  </div>';
    out  +='<div class="col-3">Reproduktivna toksičnost: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][reproduktivna_toksicnost]">  </div>';
    out  +='<div class="col-3">Toksikokinetički podaci: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][toksikokineticki_podaci]">  </div>';
    out  +='<div class="col-3">Fototoksicnost: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][fototoksicnost]">  </div>';
    out  +='<div class="col-3">Podaci o ispitivanjima na ljudima: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][podaci_o_ispitivanjima_na_ljudima]">  </div>';
    out  +='<div class="col-3">Ostali podaci: <input type="text" placeholder="" class="form-control " value="" name="'+pname+'[additional][ostali_podaci]">  </div>';
    out  +='<div class="col-12 references">Reference: ';
    out  +='<div class="row reference">';
    out  +='<div class="col-11">';
    out  +='<input type="text"  placeholder="" class="form-control " value=""  name="'+pname+'[additional][reference][]">';
    out  +='</div>';
    out  +='<div class="col-1 text-end">';
    out  +='<a class="btn btn-square btn-danger referenceRemove" type="button" data-bs-original-title="" title="">x</a>';
    out  +='</div>';
    out  +='</div>';
    out  +='<div class="row">';
    out  +='<div class="col-12 text-end">';
    out  +='<a class="btn btn-square btn-success referenceAdd" type="button" data-bs-original-title="" title="">+</a>';
    out  +='</div>';
    out  +='</div>';
    out  +='</div>';
    out  +='</div>';
    out  +='</div>';
    out  +='</div>';
    out  +='</div>';
    out  +='</div>';
  let list_class  = ".inci_list div.inci_list_"+chapter_id;

  if($(list_class).length == 0){
    let v = '<div class="card mb-2">';
        v += '<div class="card-header">';
        v += '<h5 class="mb-0">';
        v += '<button type="button" class="btn btn-link collapsed inci_parent inci_p_'+chapter_id+'" data-bs-toggle="collapse" data-bs-target="#collapseicon-tradeList_'+chapter_id+'" aria-expanded="false" aria-controls="collapseicon-tradeList"><i class="icofont icofont-arrow-right"></i><span>'+t_name+'</span><sup class="all_conc"></sup></button>';
        v += '</h5>';
        v += '</div>';
        v += '<div class="collapse" id="collapseicon-tradeList_'+chapter_id+'" aria-labelledby="collapseicon-tradeList" data-bs-parent="#tradeList">';
        v += '<div class="card-body card_'+chapter_id+'">';
        v += '<div class="inci_ul">';
        v += '<div class="inci_list_'+chapter_id+'">';
        v += '</div>';
        v += '</div>';
        v += '</div>';
        v += '</div>';
        v += '</div>';
      $(".inci_list").append(v);
      
  }

  let name     = that.attr("name").slice(0,-6);
  @if(Route::currentRouteName() == "mixturesAddIndex" || Route::currentRouteName() == "mixturesEditIndex")
    name = name.replace("mixture","ingredients")
  @endif
  console.log(name);
  let array    = [
    ['koncentracija','Concentration 0.15-1.20','conc_value','','Koncentracija',''],
    ['sed','SED (mg/kgbw/d)','sed_value','','SED',''],
    ['noael','(mg/kgbw/d)','noael_value','','NOAEL',noael],
    ['mos','PODsys/SED','mos_value','','MoS',''],
    ['mos_text','PODsys/SED','mos_text','','MoS Text',''],
    ['dermalna_apsorpcija','(μg/cm2)','daa_value','','Dermalna Apsorpcija',''],
    ['dermalna_apsorpcija_procenti','%','da_value','','Dermalna Apsorpcija u %',''],
    ['a','(mg/kgbw/day)','a_value','','A',''],
    ['ssa','cm2','ssa_value','','SSA',''],
    ['fappl','Frequency of application of finished product','fappl_value','','FFAPL',''],
];
  let add  = "<div class='row trade_li inci_li_e_"+chapter_id+"_"+id+"' data_id="+chapter_id+">";
      add+="<div class='col-2 align-self-center'><p>"+data_text+"</p>";
      add+= "<p>SED (mg/kgbw/day):</p>";
      add+= "<select class='form-select sedCalc' name="+name+"[formula]["+id+"]>";
      @foreach(\Config::get('app.formulas') as $formula)
        add+= "<option value='{{$formula}}'>{{$formula}}</option>";
      @endforeach
      add+= "</select>";
      add+=" </div>";

      add+="<div class='col-10'>";
      add+="<div class='row'>";

      $.each(array, function(k,v){
        add+= "<div class='col-3'>" +v[4]+":<input type='text' value='"+v[5]+"' placeholder='"+v[1]+"' "+v[3]+" class='form-control "+v[2]+"' name='"+name+"["+v[0]+"]["+id+"]'></div>";
      })
      add+="</div>";
      add+="</div>";
      add+=" </div>";

  $(list_class).append(add);
  if($(".additional_list_"+chapter_id).length == 0){
        $(".card_"+chapter_id).prepend(out);
      }
      
      conc_sum($(".card_"+chapter_id));
});


function ingredientGet(id){
  let object;
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
      url: '{{route("ingredientGet")}}',
      method: 'POST',
      data: {id:id},
      async: false,  
      cache: false,
      success: function(data){
        object = data;
      },
      error: function(data){
        notify(data.responseJSON.message,"Greska","danger");
      }

      });
      return object;
}

// $(document).on("change",".file_upload",function(e){
//   let that    = $(this);
//   let element = that.closest(".file_parent");
//   let spec    = element.find(".specifikacija");
//   var file_data = that.prop('files')[0];   
//   var form_data = new FormData();                  
//   form_data.append('file', file_data);
//   $.ajaxSetup({
//     headers: {
//       'X-CSRF-TOKEN': $('input[name="_token"]').val()
//     }
//   });
//   $.ajax({
//     url: '',
//     type: 'post',
//     data: form_data,
//     cache: false,
//     contentType: false,
//     processData: false,
//     success: function(data){
//       if(spec.val() != ""){
//         removeFile(spec.val());
//       }
//       spec.val(data);

//     }
//   });


// });

function removeFile(file){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
  });
  $.ajax({
    url: '{{route("removeFile")}}',
    type: 'post',
    data: {file:file},
    cache: false,
    success: function(data){
      console.log(data);
    },
  });
}
$("#productForm").on("submit",function(e){
  e.preventDefault();
  let ac    = true;
  let array = [
   ["trade_name", "Trade Ime"],
   ["dobavljac", "Dobavljac"],
   ["inci_additional", "INCI"],
];
  $.each(array,function(key,el){
    $("."+el[0]).each(function(k,v){
      if($(v).val() == "" || $(v).val() == null){
        $(v).css("border","1px solid red");
        $(v).closest("div").find("span.selection > span").addClass("borderRed");
        notify(el[1]+" je prazno","Greska","danger");
        if(ac){
          ac = false;
        }
      }
    })
  })
  if(ac){
    $('#productForm')[0].submit();
  }

})
</script>