<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="">English name</label>
            <input type="text" name="name_en" value="{{ old('name_en', $product->en_name) }}"
                placeholder="{{ __('site.Name') }}" class="form-control @error('name_en') is-invalid @enderror">
            @error('name_en')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="">Arabic name</label>
            <input type="text" name="name_ar" value="{{ old('name_ar', $product->ar_name) }}"
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
    @error('image')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
    <img width="150" class="mt-3 mx-3" src="{{ asset('uploads/images/products/' . $product->image) }}" alt="">

</div>
<div class="mb-3">
    <label for="">English Description</label>
    <textarea name="description_en" placeholder="English Description"
        class="form-control @error('description_en') is-invalid @enderror">
        {{ old('description_en', $product->en_description) }}</textarea>
    @error('description_en')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="">Arabic Description</label>
    <textarea name="description_ar" placeholder="Arabic Description"
        class="form-control @error('description_ar') is-invalid @enderror">{{ old('description_ar', $product->ar_description) }}</textarea>
    @error('descriptipn_ar')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="">Price</label>
    <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="Price"
        class="form-control @error('price') is-invalid @enderror">
    @error('price')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="">Sale Price</label>
    <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}"
        placeholder="Sale Price" class="form-control @error('sale_price') is-invalid @enderror">
    @error('sale_price')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="">Quantity</label>
    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" placeholder="Quantity"
        class="form-control @error('quantity') is-invalid @enderror">
    @error('quantity')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="">Category</label>
    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
        <option selected disabled>--{{ __('site.Select') }}--</option>
        @foreach ($categories as $item)
            <option {{ $product->category_id == $item->id ? 'Selected' : '' }} value="{{ $item->id }}">
                {{ $item->trans_name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
