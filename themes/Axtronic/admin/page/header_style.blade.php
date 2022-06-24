<label >{{__('Header Style')}}</label>
<select name="header_style" class="form-control" >
    <option value="normal" {{ ( $row->getMeta('header_style')) == 'normal' ? 'selected' : ''  }}>{{__("Normal")}}</option>
    <option value="style_1" {{( $row->getMeta('header_style')) == 'style_1' ? 'selected' : ''  }}>{{__('Style 1')}}</option>
    <option value="style_2" {{( $row->getMeta('header_style')) == 'style_2' ? 'selected' : ''  }}>{{__('Style 2')}}</option>
</select>
<input type="hidden" name="save_header_style" value="1">

<hr>
