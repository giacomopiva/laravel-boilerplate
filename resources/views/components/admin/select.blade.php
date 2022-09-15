@props(['name', 'label', 'description', 'options', 'check', 'required'])

<label for="{{ $name }}">{{ $label }} {!! ($required ?? false) ? '<span class="required">*</span>' : '' !!}</label>
<div class="form-group">
    <div class="form-line {{ $errors->has($name) ? 'error' : '' }}">
        <select class="form-control" name="{{ $name }}" id="{{ $name }}" {{ ($required ?? false) ? 'required' : '' }} >
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" @selected( old($name) ? $key == old($name) : $key == ($check ?? null) )>{{ $option }}</option>
            @endforeach
        </select>        
    </div>

    @if ($errors->has($name))
        <label class="error">{{ $errors->first($name) }}</label>
    @endif                                                    
    <div class="help-info">{{ $description }}</div>
</div>
