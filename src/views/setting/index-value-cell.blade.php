<div class="preview">
    {{str_limit($setting->value, 50)}}
    <a href="#" class="pull-right" onclick="return expandValue(this);">parse</a>
</div>
<pre style="display: none;">{{ var_export($setting->parsed_value, true) }}</pre>