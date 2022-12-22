 discount expire_date

 <div class="mb-3">
     <label for="">{{ __('site.Name') }}</label>
     <input type="text" name="name" value="{{ old('name', $coupon->name) }}" placeholder="{{ __('site.Name') }}"
         class="form-control @error('name') is-invalid @enderror">
     @error('name')
         <small class="invalid-feedback">{{ $message }}</small>
     @enderror
 </div>
 <div class="mb-3">
     <label for="">{{ __('site.Coupon') }}</label>
     <input type="text" name="coupon" value="{{ old('coupon', $coupon->coupon) }}"
         placeholder="{{ __('site.Coupon') }}" class="form-control @error('coupon') is-invalid @enderror">
     @error('coupon')
         <small class="invalid-feedback">{{ $message }}</small>
     @enderror
 </div>
 <div class="mb-3">
     <label for="">Type</label>
     <select name="type" class="form-control @error('type') is-invalid @enderror">
         <option selected disabled>--{{ __('site.Select') }}--</option>
         @foreach ($type as $value)
             <option {{ $coupon->type == $value ? 'selected' : '' }} value="{{ $value }}">{{ $value }}
             </option>
         @endforeach
     </select>
     @error('type')
         <small class="invalid-feedback">{{ $message }}</small>
     @enderror
 </div>
 <div class="mb-3">
     <label for="">Discount</label>
     <input type="number" name="discount" value="{{ old('discount', $coupon->discount) }}" placeholder="Quantity"
         class="form-control @error('discount') is-invalid @enderror">
     @error('discount')
         <small class="invalid-feedback">{{ $message }}</small>
     @enderror
 </div>
 <div class="mb-3">
     <label for="">Expire Date</label>
     <input type="date" name="expire_date" value="{{ old('expire_date', $coupon->expire_date) }}"
         class="form-control @error('expire_date') is-invalid @enderror">
     @error('expire_date')
         <small class="invalid-feedback">{{ $message }}</small>
     @enderror
 </div>
