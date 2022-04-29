<div class="mb-3">
    <label for="{{$sNameField}}" class="form-label">{{$sName}}</label>
    <textarea
        class="form-control" id="{{$sNameField}}" name="{{$sNameField}}"
        @if($isRequired)
        required
        @endif
    >{{old($sNameField, isset($obData) ? $obData->{$sNameField} : $mDefaultValue)}}</textarea>
    @if($sEmptyMessage)
        <div class="invalid-feedback">
            {{$sEmptyMessage}}
        </div>
    @else
        <div class="invalid-feedback">
            Заполните данное поле
        </div>
    @endif
    @error($sNameField)
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
</div>
