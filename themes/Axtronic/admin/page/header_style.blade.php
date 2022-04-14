<hr>
<input type="hidden" name="save_header_style" value="1">
<label >{{__('Header Style')}}</label>
<select name="header_style" class="form-control" >
    <option value="normal" {{ ( $row->getMeta('header_style')) == 'normal' ? 'selected' : ''  }}>{{__("Normal")}}</option>
    <option value="transparent" {{( $row->getMeta('header_style')) == 'transparent' ? 'selected' : ''  }}>{{__('Transparent')}}</option>
</select>
