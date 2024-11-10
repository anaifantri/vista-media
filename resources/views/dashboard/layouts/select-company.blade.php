<!-- Select City start -->
<div class="mt-1">
    <label class="text-sm text-stone-900">Perusahaan</label>
    <select id="company_id" name="company_id"
        class="flex text-semibold w-[218px]  border rounded-lg px-1 outline-none @error('company_id') is-invalid @enderror">
        <option value="pilih">Pilih Perusahaan</option>
        @foreach ($companies as $company)
            @if (old('company_id') == $company->id)
                <option value="{{ $company->id }}" selected>
                    {{ $company->name }}
                </option>
            @else
                <option value="{{ $company->id }}">{{ $company->name }}
                </option>
            @endif
        @endforeach
    </select>
    @error('company_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<!-- Select City end -->
