<div class="col-md-6">
    <input type="hidden" name="save_footer_style" value="1">
    <label >{{__('Footer Style')}}</label>
    <select name="footer_style" class="form-control" >
        <option value="" {{ ( $row->getMeta('footer_style')) == '' ? 'selected' : ''  }}>{{__("Default setting")}}</option>
        <option value="1" {{ ( $row->getMeta('footer_style')) == '1' ? 'selected' : ''  }}>{{__("Style 1")}}</option>
        <option value="2" {{( $row->getMeta('footer_style')) == '2' ? 'selected' : ''  }}>{{__("Style 2")}}</option>
        <option value="3" {{( $row->getMeta('footer_style')) == '3' ? 'selected' : ''  }}>{{__("Style 3")}}</option>
        <option value="4" {{( $row->getMeta('footer_style')) == '4' ? 'selected' : ''  }}>{{__("Style 4")}}</option>
    </select>
</div>
