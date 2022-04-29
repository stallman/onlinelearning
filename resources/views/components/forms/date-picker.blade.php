<div>
    <label for="{{$sNameField}}" class="form-label">{{$sName}}</label>
    <div class="input-group date" id="datetimepicker">
        <input type="text"
               value="{{old($sNameField, isset($obData) ? $obData->{$sNameField} : $mDefaultValue)}}"
               id="{{$sNameField}}" name="{{$sNameField}}"
               data-date-format="yyyy-mm-dd"
               class="datepicker-here form-control" data-timepicker="true"
               @if($isRequired)
               required
               @endif
        />
        <div class="input-group-text">
                        <span class="glyphicon glyphicon-calendar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-calendar" viewBox="0 0 16 16">
                              <path
                                  d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            </svg>
                        </span>
        </div>
    </div>
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
