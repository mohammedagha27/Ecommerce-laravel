<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="">English name</label>
            <input type="text" name="name_en" value="{{ old('name_en', $category->en_name) }}"
                placeholder="{{ __('site.Name') }}" class="form-control @error('name_en') is-invalid @enderror">
            @error('name_en')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="">Arabic name</label>
            <input type="text" name="name_ar" value="{{ old('name_ar', $category->ar_name) }}"
                placeholder="Arabic name" class="form-control @error('name_ar') is-invalid @enderror">
            @error('name_ar')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="">{{ __('site.Image') }}</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    <img width="150" class="mt-3 mx-3" src="{{ asset('uploads/images/categories/' . $category->image) }}" alt="">
    @error('image')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    <label for="">{{ __('site.Parent') }}</label>
    <select name="parent_id" class="form-control @error('image') is-invalid @enderror">
        <option value="">--{{ __('site.Select') }}--</option>
        @foreach ($categories as $item)
            @if ($category->name == $item->name)
                @continue
            @endif
            <option {{ $category->parent_id == $item->id ? 'Selected' : '' }} value="{{ $item->id }}">
                {{ $item->trans_name }}</option>
        @endforeach
    </select>
</div>
