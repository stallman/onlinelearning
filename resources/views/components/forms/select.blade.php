<div class="mb-3">
    <label for="{{$sNameField}}" class="form-label">{{$sName}}</label>
    <select
        class="form-control" id="{{$sNameField}}" name="{{$sNameField}}"
        @if($bIsRequired)
        required
        @endif
        @if($bIsMultiple)
            multiple
        @endif
    >
        @foreach($arData as $obItem)
            @if(old($sNameField, isset($obData) ? $obData->{$sNameField} : null) == $obItem->{$sValueKey})
                <option value="{{ $obItem->{$sValueKey} }}" selected>{{ $obItem->{$sDisplayKey} }}</option>
            @else
                <option value="{{ $obItem->{$sValueKey} }}">{{ $obItem->{$sDisplayKey} }}</option>
            @endif
        @endforeach
    </select>
    @if($sEmptyMessage)
        <div class="invalid-feedback">
            {{$sEmptyMessage}}
        </div>
    @else
        <div class="invalid-feedback">
            Выберите данное поле
        </div>
    @endif
    @error($sNameField)
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
</div>
