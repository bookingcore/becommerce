<hr>
<input type="hidden" name="save_header_style" value="1">
<label >{{__('Header Style')}}</label>
<select name="header_style" class="form-control" >
    <option value="1" {{ ( $row->getMeta('header_style')) == '1' ? 'selected' : ''  }}>{{__("style 1")}}</option>
    <option value="2" {{( $row->getMeta('header_style')) == '2' ? 'selected' : ''  }}>{{__('style 2')}}</option>
    <option value="3" {{( $row->getMeta('header_style')) == '3' ? 'selected' : ''  }}>{{__("style 3")}}</option>
</select>
