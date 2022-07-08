@php $main_color = setting_item('style_main_color','#5191fa');
$style_typo = json_decode(setting_item_with_lang('style_typo',false,"{}"),true);
@endphp

    body{
    @if(!empty($style_typo) && is_array($style_typo))
        @foreach($style_typo as $k=>$v)
            @if($v)
                {{str_replace('_','-',$k)}}:{!! $v !!};
            @endif
        @endforeach
    @endif
    }
    @if(!empty($style_h1_font_family = setting_item_with_lang("style_h1_font_family") ))
        h1{
            font-family: {{ $style_h1_font_family }}, sans-serif
        }
    @endif
    @if(!empty($style_h2_font_family = setting_item_with_lang("style_h2_font_family") ))
        h2{
            font-family: {{ $style_h2_font_family }}, sans-serif
        }
    @endif
    @if(!empty($style_h3_font_family = setting_item_with_lang("style_h3_font_family") ))
        h3{
            font-family: {{ $style_h3_font_family }}, sans-serif
        }
    @endif

    {!! (setting_item('style_custom_css')) !!}
    {!! (setting_item_with_lang_raw('style_custom_css')) !!}
