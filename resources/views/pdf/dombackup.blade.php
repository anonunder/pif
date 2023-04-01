@php 


$content = json_decode($product->content);

@endphp
<html>
<head>
    <title>My PDF</title>
</head>
<body>
<script type="text/php">
$GLOBALS['chapters'] = array();
$GLOBALS['max_object'] = 0;
</script>
<h2>Table of Contents</h2>
		<ol>
		@php $b = 1;@endphp
	@foreach($content as $index => $product)
		<li>{{$product->chapter_name}} ....................... page %%CH{{$b}}%%</li>
			@php $b++;@endphp
		@endforeach
</ol>

<script type="text/php">
$GLOBALS['max_object'] = count($pdf->get_cpdf()->objects);
</script>
    <div id="content">
		@php $b = 1;@endphp
        @foreach($content as $index => $product)
		<h2>{{$product->chapter_name}}</h2>
		<script type="text/php">
			$GLOBALS['chapters'][{{$b}}] = $pdf->get_page_number();
		</script>

			@php $b++;@endphp
		@endforeach
    </div>

	<script type="text/php">
	$font = $fontMetrics->getFont("Arial", "bold");
	$pdf->page_text(555, 745, "Page {PAGE_NUM}/{PAGE_COUNT}", $font, 7, array(0, 0, 0));
            for ($i = 0; $i <= $GLOBALS['max_object']; $i++) {
                if (!array_key_exists($i, $pdf->get_cpdf()->objects)) {
                    continue;
                }
                $object = $pdf->get_cpdf()->objects[$i];
                foreach ($GLOBALS['chapters'] as $chapter => $page) {
                    if (array_key_exists('c', $object)) {
                        $object['c'] = str_replace( '%%CH'.$chapter.'%%' , $page , $object['c'] );
                        $pdf->get_cpdf()->objects[$i] = $object;
                    }
                }
            }
        </script>
</body>
</html>








===============================[ verzija 2]================================

@php 


$content        = json_decode($product->content);
$locale         = $product->locale;
$inci_name      = "inci_name_".$locale;
$content_locale = "content_".$locale;
// print_r($content);
// die();
@endphp
<html>
<head>
    <title>PIF</title>
    <link type="text/css" rel="stylesheet" href="{{\url('/')}}/assets/css/pdf.css" />
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/css/bootstrap-pdf.css" />
</head>
{{-- <body style="width: 600px; margin: 0 auto; border-left: 1px solid red; border-right: 1px solid red;"> --}}
<body>
<div class="row chapter">
    <div class="col-12">
        <img src="{{url('/')}}/assets/images/pdf/first_image.png">
    </div>
    <div class="col-12">
        <p style="font-size:12px;">Urađeno {{\Carbon\Carbon::parse($product->created_at)->format("d.m.Y")}} Ver. {{$product->version}}</p>
    </div>
    <div class="col-12 text-center" style="margin: 50px 0;">
        <div style="font-size:12px;" >
            <span class="blue"><b>PRODUCT INFORMATION FILE (PIF)</b></span><br>
            <span class="blue"><b>DOSIJE O BEZBEDNOSTI KOZMETIČKOG PROIZVODA (CPSR)</b></span><br>
            <span class="blue">(U saglasnosti sa EC Uredbom N ̊ 1223/2009)</span><br>
            <span class="blue">Naziv proizvoda: {{$product->name}}, kod {{$product->category}}</span>
        </div>
    </div>
    <div class="col-12" style="margin-top:550px; margin-bottom: 5px;">
        <div style="font-size:12px;" >
            {{__("main.responsible_person")}}<br>
            {!!$product->company->responsible_person!!}
        </div>
    </div>
</div>
<script type="text/php">
    $GLOBALS['chapters'] = array();
    $GLOBALS['max_object'] = 0;
</script>
<div class="row chapter page_break" >
    <div class="col-12">
        <ul style="font-size:11px;">
            @php $b = 1;@endphp
            <table class="border" style="margin-bottom: 10px;">
                <tbody>
                    <tr>
                    <td class="blue"><b>Naziv proizvoda:</b></td>
                    <td>{{$product->name}}</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td class="blue"><b>Naziv firme:</b></td>
                    <td>{{$product->company->name}}</td>
                    <td class="blue"><b>Verzija:</b></td>
                    <td>{{$product->version}}</td>
                    </tr>
                    <tr>
                    <td class="blue"><b>Broj formule:</b></td>
                    <td>{{$product->formula}}</td>
                    <td class="blue"><b>Datum:</b></td>
                    <td>{{\Carbon\Carbon::parse($product->created_at)->format("d.m.Y")}}</td>
                    </tr>
                    </tbody>
                </table>
            @foreach($content as $index => $chapter)
            @php $dots = substr_count($chapter->chapter_name, "."); @endphp
            <li><span class="blue @if($dots == 1 || $dots == 0) f_b @else f_n @endif">{{$chapter->chapter_name}}</span> .......................<span class="notFont blue">%%CH{{$b}}%%</span></li>
            @php $b++;@endphp
            @endforeach
        </ul>
    </div>
</div>


<script type="text/php">
    $GLOBALS['max_object'] = count($pdf->get_cpdf()->objects);
</script>
    <div id="content" class="chapter page_break">
		@php $b = 1;@endphp
        @foreach($content as $index => $chapter)
        @php 
            $dots = substr_count($chapter->chapter_name, "."); 
            if($dots == 1 || $dots == 0){ 
                $c = "f_b"; 
                $c2 = "f_b_v"; 
            }else{
                $c = "f_n_t";
                $c2 = "f_n_t_v";
            }
        @endphp
        <div class="row">
            <div class="col-12">
                <p style="margin:0;" class="blue {{$c}}">{{$chapter->chapter_name}}</p>
            </div>
            @if(isset($chapter->data))
                @if($chapter->data->type == "texteditor")
                    @foreach($chapter->data->content as $k => $v)
                    @php
                    switch($chapter->id){
                        case 31:
                            $on = "order-md-3";
                        break;
                        case 52:
                            $on = "order-md-2";
                        break;
                        default:
                            $on = "";
                    }
                    // if($chapter->id == 31){
                    //     $on = "order-md-3";
                    // }elseif($chapter->id == 52){
                    //     $on = "order-md-2";
                    // }elseif($chapter->id){
                        
                    // }else{
                    //     $on = "";
                    // }
                    $text = $v->text;
                    $text = str_replace("{product_name}",$product->name,$text);
                    $text = str_replace("{product_version}",$product->version,$text);
                    $text = str_replace("{product_category}",$product->category,$text);
                    $text = str_replace("{product_formula}",$product->formula,$text);
                    @endphp
                    <div class="col-12 {{$on}}">
                        <div class="textValue {{$c2}}">{!!$text!!}</div>
                    </div>
                    @endforeach
                    
                @elseif($chapter->data->type == "table")
                    @if($chapter->id == 3)
                    @php 
                    $ar    = array();
                    $ar_in = array();
                    $spec  = array();
                    $tlist = $chapter->data->content; 
                    foreach($tlist as $k => $v){
                        $spec[] = $v->specifikacija;
                        $inci  = $v->inci_name->id;
                        foreach($inci as $id){
                            if(!in_array($id,$ar)){
                                $ar[] = $id;
                            }
                            $ar_in[$k]['trade_name']                   = $v->trade_name;
                            $ar_in[$k]['trade_conc']                   = $v->koncentracija;
                            $ar_in[$k]['trade_necistoce']              = $v->necistoce;
                            $ar_in[$k]['trade_funkcija']               = $v->funkcija;
                            $ar_in[$k]['dobavljac']                    = \App\Models\Distributors::find($v->dobavljac)->name;
                            $ar_in[$k]['data'][$id]['ingredient_name'] = \App\Models\Ingredients::find($id)->$inci_name;
                            if(isset($v->inci_name->formula->{$id})){
                                $ar_in[$k]['data'][$id]['formula'] = $v->inci_name->formula->{$id};
                            }else{
                                $ar_in[$k]['data'][$id]['formula'] = "";
                            }
                            if(isset($v->inci_name->formula->{$id})){
                                $ar_in[$k]['data'][$id]['koncentracija'] = $v->inci_name->koncentracija->{$id};
                            }else{
                                $ar_in[$k]['data'][$id]['koncentracija'] = "";
                            }
                            if(isset($v->inci_name->formula->{$id})){
                                $ar_in[$k]['data'][$id]['sed'] = $v->inci_name->sed->{$id};
                            }else{
                                $ar_in[$k]['data'][$id]['sed'] = "";
                            }
                            if(isset($v->inci_name->formula->{$id})){
                                $ar_in[$k]['data'][$id]['noael'] = $v->inci_name->noael->{$id};
                            }else{
                                $ar_in[$k]['data'][$id]['noael'] = "";
                            }
                            if(isset($v->inci_name->formula->{$id})){
                                $ar_in[$k]['data'][$id]['mos'] = $v->inci_name->mos->{$id};
                            }else{
                                $ar_in[$k]['data'][$id]['mos'] = "";
                            }
                            if(isset($v->inci_name->formula->{$id})){
                                $ar_in[$k]['data'][$id]['mos_text'] = $v->inci_name->mos_text->{$id};
                            }else{
                                $ar_in[$k]['data'][$id]['mos_text'] = "";
                            }
                            if(isset($v->inci_name->dermalna_apsorpcija->{$id})){
                                $ar_in[$k]['data'][$id]['dermalna_apsorpcija'] = $v->inci_name->dermalna_apsorpcija->{$id};
                            }else{
                                $ar_in[$k]['data'][$id]['dermalna_apsorpcija'] = "";
                            }
                        }

                    }
                    $spec = array_filter($spec);
                    $product->pdf_specifications = json_encode($spec);
                    $product->save();
                    $ar = array_filter($ar);
                    $ar = array_values($ar);
                    $ch_in = \App\Models\Ingredients::find($ar);
                    @endphp

                    <div class="col-12">
                        <span class="f_n_t"><b>Ingredients:</b>@foreach($ch_in as $in) {{$in->$inci_name}}, @endforeach</span>
                    </div>
                    <div class="col-12">
                        <table class="border">
                            <tbody>
                                <tr>
                                    <td><b>Trade name</b></td>
                                    <td><b>Dobavljač</b></td>
                                    <td><b>INCI name</b></td>
                                    <td><b>CAS broj </b></td>
                                    <td><b>EC </b></td>
                                    <td><b>Funkcija</b></td>
                                </tr>
                            @foreach($tlist as $index => $list)
                            @php 
                                $ids = $list->inci_name->id;
                                $ingredients = App\Models\Ingredients::find($ids);
                            @endphp
                            <tr>
                                <td>{{$list->trade_name}}</td>
                                <td>{{\App\Models\Distributors::find($list->dobavljac)->name}}</td>
                                <td>
                                <table class="border_bottom noborder"  style="width: 100%">
                                    @foreach($ingredients as $ingredient)
                                    <tr class="child">
                                        <td class="child">
                                            {{$ingredient->$inci_name}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                </td>
                                <td><table class="border_bottom noborder"  style="width: 100%">
                                        @foreach($ingredients as $ingredient)
                                        <tr class="child" >
                                            <td class="child" style='width: 100%'>
                                                {{$ingredient->cas_number}} @if(isset($list->inci_name->koncentracija->{$ingredient->id} )) @if(count($ids) > 1)({{ $list->inci_name->koncentracija->{$ingredient->id} }}%) @endif @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </td>
                                <td><table class="border_bottom noborder"  style="width: 100%">
                                    @foreach($ingredients as $ingredient)
                                    <tr class="child" >
                                        <td class="child" style='width: 100%'>
                                            @if(json_decode($ingredient->$content_locale)->items->kompozicija[0]->ec_no)
                                             {{json_decode($ingredient->$content_locale)->items->kompozicija[0]->ec_no}}
                                             @else
                                             -
                                             @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                    </td>
                                <td>{{$list->funkcija}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    @endif
                @endif
                
                @if($chapter->id == 4)

                <div class="col-12">
                        
                    <table class="border" style="margin: 10px 0;">
                        <tbody>
                            <tr>
                                <td><b>Dobavljač</b></td>
                                <td><b>Trade name</b></td>
                                <td><b>INCI name</b></td>
                                <td><b></b></td>
                                <td><b>Conc. %</b></td>
                            </tr>
                        @foreach($ar_in as $in_index => $in_value)
                        <tr>
                            <td>{{$in_value['trade_name']}}</td>
                            <td>{{$in_value['dobavljac']}}</td>
                            <td>
                            <table class="border_bottom noborder"  style="width: 100%">
                                @foreach($in_value['data'] as $ing)
                                @php
                                    if(!isset($ing['koncentracija'])){
                                        $ing['koncentracija'] = 0;
                                    }
                                @endphp
                                <tr class="child">
                                    <td class="child">
                                        {{$ing['ingredient_name']}} @if($ing['koncentracija'] != 0) @if($ing['koncentracija'] != "100") ({{$ing['koncentracija']}} %)  @endif @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            </td>
                            <td>
                                <table class="border_bottom noborder"  style="width: 100%">
                                    @foreach($in_value['data'] as $ing_index => $ing)
                                    @php 
                                        if(!isset($in_value['trade_conc'])){
                                            $in_value['trade_conc'] = 0;
                                        }
                                        if(!is_numeric($in_value['trade_conc'])){
                                            $in_value['trade_conc'] = 0;
                                        }
                                        $explode = explode("-",$ing['koncentracija']);
                                        $max     = max($explode);
                                        if(!is_array($explode)){
                                            $ing['koncentracija'] = 0;
                                        }
                                         if(isset($ing['koncentracija'])){
                                            $c = $in_value['trade_conc'] / 100 * $max; 
                                         }else{
                                            $c = $in_value['trade_conc'];
                                         }
                                         $ar_in[$in_index]['data'][$ing_index]['conc_difference'] = $c;
                                         if(isset($ing['sed'])){
                                            $ar_in[$in_index]['data'][$ing_index]['sed'] = $ing['sed'];
                                         }else{
                                            $ar_in[$in_index]['data'][$ing_index]['sed'] = 0;
                                         }
                                    @endphp
                                    <tr class="child" >
                                        <td class="child" style='width: 100%'>
                                           @if($c != 0)
                                            {{$c}}
                                           @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td>
                                @if($in_value['trade_conc'] != 0)
                                    {{$in_value['trade_conc']}}
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                @endif

                @if($chapter->id == 11)
                    <div class="col-12">
                        <table class="border" style="margin-bottom: 10px;">
                            <tbody>
                                <tr>
                                <td><b>Naziv supstance/smeše</b></td>
                                <td><b>Mikrobiološki izveštaj (CoA)</b></td>
                                </tr>
                                @foreach($tlist as $in)
                                <tr>
                                    <td>{{$in->trade_name}}</td>
                                    <td>@if(isset($in->ispunjava_uslove)) Ispunjava uslove @else Neispunjava uslove @endif</td>
                                </tr>
                                @endforeach
                                
                                
                                </tbody>
                            </table>
                    </div>
                @endif

                @if($chapter->id == 15)
                    <div class="col-12">
                        <table class="border" style="margin-bottom: 10px;">
                            <tbody>
                                <tr>
                                <td><b>Naziv supstance/smeše</b></td>
                                <td><b>Nečistoće</b></td>
                                </tr>
                                @foreach($tlist as $in)
                                <tr>
                                    <td>{{$in->trade_name}}</td>
                                    <td>@if(isset($in->necistoce)) {{$in->necistoce}} @endif</td>
                                </tr>
                                @endforeach
                                
                                
                                </tbody>
                            </table>
                    </div>
                @endif

                @if($chapter->id == 30)
                @php 
                
                $toArray   = array();
                $arrayData = array();
                $d_ingred = \App\Models\Ingredients::find($ar);
                foreach($ar_in as $data_in){
                    $conc_diff = 0;
                    $sed_diff  = 0;
                    foreach($data_in['data'] as $data_id => $data_value){
                            $toArray[$data_id]['sed'][]             = $data_value['sed'];
                            $toArray[$data_id]['mos'][]             = $data_value['mos'];
                            $toArray[$data_id]['noael'][]           = $data_value['noael'];
                            $toArray[$data_id]['conc_difference'][] = $data_value['conc_difference'];
                            $toArray[$data_id]['trade_conc']        = $data_in['trade_conc'];
                    }
                    
                }
                
                @endphp
                <div class="col-12">
                    <table class="border" style="margin-bottom: 10px;">
                        <tbody>
                            <tr>
                            <td><b>INCI naziv</b></td>
                            <td><b>Koncentracija %</b></td>
                            <td><b>SED (mg/kgbw/d)</b></td>
                            </tr>
                            @php 
                            $conc_zbir_all = 0;
                            $sed_zbir_all  = 0;
                            @endphp
                            @foreach($d_ingred as $in)
                            @php 
                                $conc_diff_sum = array_sum($toArray[$in->id]['conc_difference']); 
                                $sed_diff_sum = array_sum($toArray[$in->id]['sed']); 

                                $conc_zbir_all += $conc_diff_sum;
                                $sed_zbir_all += $sed_diff_sum;
                            @endphp
                            <tr>
                                <td>{{$in->$inci_name}}</td>
                                <td>@php echo $conc_diff_sum; @endphp </td>
                                {{-- <td>{{$in->cas_number}}, {!!html_entity_decode(str_replace('', '\n', json_decode($in->$content_locale)->funkcija))!!}</td> --}}
                                <td>@php echo $sed_diff_sum; @endphp </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td>=<b>{{$conc_zbir_all}}<b></td>
                                <td></td>
                            </tr>
                            
                            </tbody>
                        </table>
                </div>
            @endif


@php 

@endphp


            @if($chapter->id == 31)
                <div class="col-12 order-md-1 f_n_t inciList" style="margin-top: 10px;">

                    @foreach($tlist as $ind => $sastojak)
                    @php $ingr = \App\Models\Ingredients::find($sastojak->inci_name->id); @endphp
                    <span class="blue"><b>INCI NAME:</b> @foreach($ingr as $in) {!!$in->$inci_name!!}, @endforeach</span><br>
                    <span class="blue"><b>Trade ime:</b> {{$sastojak->trade_name}}</span><br>
                    <span class="blue"><b>Isporucilac:</b> {{\App\Models\Distributors::find($sastojak->dobavljac)->name}}</span><br><br>
                    <div class="other">
                    <span class="blue"><b>Kompozicija</b></span><br>
                    <table class="border" style="margin-bottom: 10px;">
                        <tbody>
                            <tr>
                            <td><b>INCI naziv</b></td>
                            <td><b>Chemical name</b></td>
                            <td><b>Concentration(%)</b></td>
                            <td><b>CAS No</b></td>
                            <td><b>EC No</b></td>
                            </tr>
                            @foreach($ingr as $in)
                            @php 
                                 $ingr_cont = json_decode($in->$content_locale);
                            @endphp
                            <tr>
                                <td>{!!$in->$inci_name!!}</td>
                                <td>@if(isset($ingr_cont->items->kompozicija[0]->chemical_name)) {{$ingr_cont->items->kompozicija[0]->chemical_name}}@endif</td>
                                <td>{!!$sastojak->inci_name->koncentracija->{$in->id} !!} %</td>
                                <td>{!!$in->cas_number!!}</td>
                                <td>{!!$ingr_cont->items->kompozicija[0]->ec_no!!}</td>
                            </tr>
                            @endforeach
                            
                            
                            </tbody>
                        </table>
                        @if(count($ingr) > 1 && isset($sastojak->additional))
                            <span><b class="blue">Nečistoće:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->necistoce)) !!}</span><br>
                            <span><b class="blue">Funkcija:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->funkcija)) !!}</span><br>
                            <span><b class="blue">Regulatory status:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->regulatory_status)) !!}</span><br>
                            <span><b  class="blue">Fizičko-hemijske karakteristike:</b> </span><br>
                            @endif
                        <table class="border" style="margin-bottom: 10px;">
                            <tbody>
                                <tr>
                                    <td><b>Karakteristike</b></td>
                                    <td><b>Vrednost</b></td>
                                    <td><b>Reference</b></td>
                                </tr>
                                @if(count($ingr) > 1 && isset($sastojak->additional))

                                <tr>
                                    <td>Molekulska masa (MW)</td>
                                    @php $t = explode("|",$sastojak->additional->molekulska_masa); @endphp
                                    <td>@if(isset($t[0])) {{$t[0]}} @endif</td>
                                    <td>@if(isset($t[1])) {{$t[1]}} @endif</td>
                                </tr>
                                <tr>
                                    <td>Opis</td>
                                    @php $t = explode("|",$sastojak->additional->opis); @endphp
                                    <td>@if(isset($t[0])) {{$t[0]}} @endif</td>
                                    <td>@if(isset($t[1])) {{$t[1]}} @endif</td>
                                </tr>
                                <tr>
                                    <td>Log Pow</td>
                                    @php $t = explode("|",$sastojak->additional->log_pow); @endphp
                                    <td>@if(isset($t[0])) {{$t[0]}} @endif</td>
                                    <td>@if(isset($t[1])) {{$t[1]}} @endif</td>
                                </tr>
                                <tr>
                                    <td>Tačka topljenja</td>
                                    @php $t = explode("|",$sastojak->additional->tacka_topljenja); @endphp
                                    <td>@if(isset($t[0])) {{$t[0]}} @endif</td>
                                    <td>@if(isset($t[1])) {{$t[1]}} @endif</td>
                                </tr>
                                <tr>
                                    <td>Rastvorljivost</td>
                                    @php $t = explode("|",$sastojak->additional->rastvorljivost); @endphp
                                    <td>@if(isset($t[0])) {{$t[0]}} @endif</td>
                                    <td>@if(isset($t[1])) {{$t[1]}} @endif</td>
                                </tr>

                                @else

                                    @foreach($ingr_cont->items->fh_karakteristika as $fh)
                                    <tr>
                                        <td>{{$fh->karakteristike}}</td>
                                        <td>{{$fh->vrednost}}</td>
                                        <td>{{$fh->reference}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                
                                
                                </tbody>
                            </table>

                        @if(count($ingr) <= 1)
                        <span><b class="blue">Nečistoće:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->necistoce)) !!}</span><br>
                        <span><b class="blue">Funkcija:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->funkcija)) !!}</span><br>
                        <span><b  class="blue">Regulatory status:</b> {!! html_entity_decode($ingr_cont->regulatory_status) !!}</span><br>
                        <span><b  class="blue">Fizičko-hemijske karakteristike:</b> </span><br>
                        <table class="border" style="margin-bottom: 10px;">
                            <tbody>
                                <tr>
                                <td><b>Karakteristike</b></td>
                                <td><b>Vrednost</b></td>
                                <td><b>Reference</b></td>
                                </tr>
                                @foreach($ingr_cont->items->fh_karakteristika as $fh)
                                <tr>
                                    <td>{{$fh->karakteristike}}</td>
                                    <td>{{$fh->vrednost}}</td>
                                    <td>{{$fh->reference}}</td>
                                </tr>
                                @endforeach
                                
                                
                                </tbody>
                            </table>
                        @endif
                        
                            
                            @if(count($ingr) > 1 && isset($sastojak->additional))
                                <span><b class="blue">Akutna toksičnost oralno:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->akutna_toksicnost_oralno)) !!}</span><br>
                                <span><b class="blue">Akutna toksičnost dermalno:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->akutna_toksicnost_dermalno)) !!}</span><br>
                                <span><b class="blue">Akutna toksičnost inhalacija:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->akutna_toksicnost_inhalacija)) !!}</span><br>
                                <span><b class="blue">Iritacija kože/korozija:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->iritacija_koze)) !!}</span><br>
                                <span><b class="blue">Iritacija oka:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->iritacija_oka)) !!}</span><br>
                                <span><b class="blue">Senzitizacija:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->senzitizacija)) !!}</span><br>
                            @else
                                <span><b class="blue">Akutna toksičnost oralno:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->akutna_toksicnost_oralno)) !!}</span><br>
                                <span><b class="blue">Akutna toksičnost dermalno:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->akutna_toksicnost_dermalno)) !!}</span><br>
                                <span><b class="blue">Akutna toksičnost inhalacija:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->akutna_toksicnost)) !!}</span><br>
                                <span><b class="blue">Iritacija kože/korozija:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->iritacija_koze)) !!}</span><br>
                                <span><b class="blue">Iritacija oka:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->iritacija_oka)) !!}</span><br>
                                <span><b class="blue">Senzitizacija:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->senzitizacija)) !!}</span><br>
                            @endif
                            
                            <span><b class="blue">Dermalna Apsorpcija:</b> </span><br>
                            <table class="border" style="margin-bottom: 15px;">
                                <tbody>
                                    <tr>
                                    <td><b>INCI Name</b></td>
                                    <td><b>Vrednost</b></td>
                                    <td><b>Komentar</b></td>
                                    <td><b>Reference</b></td>
                                    </tr>
                                    @foreach($ingr as $in)
                                        <tr>
                                        @php 
                                            $ingr_cont = json_decode($in->$content_locale);
                                        @endphp
                                        <td>{{$in->$inci_name}}</td>
                                        <td>{{$sastojak->inci_name->dermalna_apsorpcija->{$in->id} }}</td>
                                        <td>{{$ingr_cont->items->d_apsorpcija->komentar}}</td>
                                        <td>{{$ingr_cont->items->d_apsorpcija->reference}}</td>
                                        </tr>
                                    @endforeach
                                    
                                    
                                    </tbody>
                                </table>
                            @if(count($ingr) > 1 && isset($sastojak->additional))
                                
                                <span><b class="blue">Hronična (ponovljena) izloženost:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->hronicna_ponovljena_izlozenost)) !!}</span><br>
                                <span><b class="blue">Mutagenost/Genotoksičnost: </b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->mategenost_genotoksicnost)) !!}</span><br>
                                <span><b class="blue">Karcinogenost:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->karcinogenost)) !!}</span><br>
                                <span><b class="blue">Reproduktivna toksičnost:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->reproduktivna_toksicnost)) !!}</span><br>
                                <span><b class="blue">Toksikokinetički podaci:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->toksikokineticki_podaci)) !!}</span><br>
                                <span><b class="blue">Fototoksičnost:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->fototoksicnost)) !!}</span><br>
                                <span><b class="blue">Podaci o ispitivanjima na ljudima:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->podaci_o_ispitivanjima_na_ljudima)) !!}</span><br>
                                <span><b class="blue">Ostali podaci:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->ostali_podaci)) !!}</span><br>


                            @else
                                <span><b class="blue">Hronična (ponovljena) izloženost:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->hronicna_izlozenost)) !!}</span><br>
                                <span><b class="blue">Mutagenost/Genotoksičnost: </b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->muragenost_genotoksicnost)) !!}</span><br>
                                <span><b class="blue">Karcinogenost:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->karcinogenost)) !!}</span><br>
                                <span><b class="blue">Reproduktivna toksičnost:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->reproduktivna_toksicnost)) !!}</span><br>
                                <span><b class="blue">Toksikokinetički podaci:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->toksikokineticki_podaci)) !!}</span><br>
                                <span><b class="blue">Fototoksičnost:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->fototoksicnost)) !!}</span><br>
                                <span><b class="blue">Podaci o ispitivanjima na ljudima:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->podaci_o_ispitivanjima_ljudi)) !!}</span><br>
                                <span><b class="blue">Ostali podaci:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->z_ostali_podaci)) !!}</span><br>
                                @endif
                                <span><b class="blue">NOAEL vrednosti za procenu rizika:</b> </span><br>
                                <table class="border" style="margin-bottom: 10px;">
                                    <tbody>
                                        <tr>
                                        <td><b>INCI Name</b></td>
                                        <td><b>NOAEL(mg/kgbw/d)</b></td>
                                        <td><b>NOAEC inhalation</b></td>
                                        <td><b>Reference</b></td>
                                        </tr>
                                        @foreach($ingr as $in)
                                        @php 
                                            $ingr_cont = json_decode($in->$content_locale);
                                        @endphp
                                        <tr>
                                            <td>{{$in->$inci_name}}</td>
                                            <td>{{$ingr_cont->items->noael->noael}}</td>
                                            <td>{{$ingr_cont->items->noael->inhalation}}</td>
                                            <td>{{$ingr_cont->items->noael->reference}}</td>
                                        </tr>
                                    @endforeach
                                        
                                        
                                        </tbody>
                                    </table>
                                    @if(count($ingr) > 1 && isset($sastojak->additional))
                                    <span><b class="blue">Zaključak:</b> {!! html_entity_decode(str_replace('', '\n', $sastojak->additional->zakljucak)) !!}</span><br>
                                    <span><b class="blue">Reference:</b></span><br>
                                    <ol>
                                        @foreach($sastojak->additional->reference as $ref)
                                            <li>{{$ref}}</li>
                                        @endforeach
                                    </ol>
                                    @else
                                    <span><b class="blue">Zaključak:</b> {!! html_entity_decode(str_replace('', '\n', $ingr_cont->zakljucak)) !!}</span><br>
                                    <span><b class="blue">Reference:</b></span><br>
                                    <ol>
                                        @foreach($ingr_cont->items->reference as $ref)
                                            <li>{{$ref->text}}</li>
                                        @endforeach
                                    </ol>
                                    @endif
                                    

                                </div>


                    @endforeach
                </div>
                <div class="col-12 order-md-2">
                    <table class="border" style="margin-bottom: 10px;">
                        <tbody>
                            <tr>
                            <td><b>INCI naziv</b></td>
                            <td><b>Koncentracija %</b></td>
                            <td><b>CAS broj i funkcija</b></td>
                            <td><b>SED (mg/kgbw/d)</b></td>
                            <td><b>NOAEL (mg/kgbw/d)</b></td>
                            <td><b>MoS=PODsys/SED</b></td>
                            </tr>
                            @foreach($d_ingred as $in)
                            <tr>
                                <td>{{$in->$inci_name}}</td>
                                <td>@php echo array_sum($toArray[$in->id]['conc_difference']); @endphp</td>
                                <td>{{$in->cas_number}}, {!!html_entity_decode(str_replace('', '\n', json_decode($in->$content_locale)->funkcija))!!}</td>
                                <td>@php echo array_sum($toArray[$in->id]['sed']); @endphp</td>
                                <td>@php echo array_sum($toArray[$in->id]['noael']); @endphp</td>
                                <td>@php echo array_sum($toArray[$in->id]['mos']); @endphp</td>
                            </tr>
                            @endforeach
                            
                            
                            </tbody>
                        </table>
                </div>
            @endif
                
            @endif

            @if($chapter->id == 50)
            <div class="col-12 page_break">

            </div>
            @endif
            @if($chapter->id == 52)
            <div class="col-12 order-md-1" style="margin-bottom: 10px;">
                <p class="f_n_t blue" style="margin: 5px 0;"><b>{{$product->name}}</b></p>
                <span class="f_n_t"><b>Ingredients:</b>@foreach($ch_in as $in) {{$in->$inci_name}}, @endforeach</span>
            </div>
            @endif
        </div>
		<script type="text/php">
			$GLOBALS['chapters'][{{$b}}] = $pdf->get_page_number();
		</script>

			@php $b++;@endphp
		@endforeach
    </div>

	<script type="text/php">
	$font = $fontMetrics->getFont("Arial", "bold");
	$pdf->page_text(555, 760, "Page {PAGE_NUM}/{PAGE_COUNT}", $font, 7, array(0, 0, 0));
            for ($i = 0; $i <= $GLOBALS['max_object']; $i++) {
                if (!array_key_exists($i, $pdf->get_cpdf()->objects)) {
                    continue;
                }
                $object = $pdf->get_cpdf()->objects[$i];
                foreach ($GLOBALS['chapters'] as $chapter => $page) {
                    if (array_key_exists('c', $object)) {
                        $object['c'] = str_replace( '%%CH'.$chapter.'%%' , $page , $object['c'] );
                        $pdf->get_cpdf()->objects[$i] = $object;
                    }
                }
            }
        </script>
</body>
</html>