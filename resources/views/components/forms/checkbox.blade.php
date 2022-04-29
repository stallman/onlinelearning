<div class="mb-3">
    <label for="{{$sNameField}}" class="form-label">{{$sName}}</label>
    <input
        type="hidden" name="{{$sNameField}}"
        value="0"
    >
    <input
        type="checkbox" id="{{$sNameField}}" name="{{$sNameField}}"
        value="1"
        @if($isRequired)
        required
        @endif
        @if(old($sNameField) || (isset($obData) && $obData->{$sNameField} === 1))
        checked
        @endif
    >
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
